<?php

namespace models;

class Echange
{
    private ?int $id;
    private ?User $demandeur;
    private ?User $receveur;
    private ?StatutEchange $statut;
    private ?string $date_demande;
    private ?string $date_reponse;

    public function __construct()
    {
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): void
    {
        $this->id = $id;
    }

    public function getDemandeur(): ?User
    {
        return $this->demandeur;
    }

    public function setDemandeur(?User $demandeur): void
    {
        $this->demandeur = $demandeur;
    }

    public function getReceveur(): ?User
    {
        return $this->receveur;
    }

    public function setReceveur(?User $receveur): void
    {
        $this->receveur = $receveur;
    }

    public function getStatut(): ?StatutEchange
    {
        return $this->statut;
    }

    public function setStatut(?StatutEchange $statut): void
    {
        $this->statut = $statut;
    }

    public function getDateDemande(): ?string
    {
        return $this->date_demande;
    }

    public function setDateDemande(?string $date_demande): void
    {
        $this->date_demande = $date_demande;
    }

    public function getDateReponse(): ?string
    {
        return $this->date_reponse;
    }

    public function setDateReponse(?string $date_reponse): void
    {
        $this->date_reponse = $date_reponse;
    }

    public function create($pdo)
    {
        $stmt = $pdo->prepare('INSERT INTO echanges (demandeur_id, receveur_id, statut_id) VALUES (:demandeur_id, :receveur_id, :statut_id)');
        $stmt->execute([
            'demandeur_id' => $this->getDemandeur()->getId(),
            'receveur_id' => $this->getReceveur()->getId(),
            'statut_id' => $this->getStatut()->getId()
        ]);
        $this->setId($pdo->lastInsertId());
    }

    public function update($pdo)
    {
        $stmt = $pdo->prepare('UPDATE echanges SET statut_id = :statut_id, date_reponse = :date_reponse WHERE id = :id');
        $stmt->execute([
            'statut_id' => $this->getStatut()->getId(),
            'date_reponse' => $this->getDateReponse(),
            'id' => $this->getId()
        ]);
    }

    public function delete($pdo)
    {
        $stmt = $pdo->prepare('DELETE FROM echanges WHERE id = :id');
        $stmt->execute(['id' => $this->getId()]);
    }

    public function findById($pdo)
    {
        $stmt = $pdo->prepare('SELECT * FROM echanges WHERE id = :id');
        $stmt->execute(['id' => $this->getId()]);
        $echange = $stmt->fetch();
        if ($echange) {
            $this->setDateDemande($echange['date_demande']);
            $this->setDateReponse($echange['date_reponse']);
            
            // Load related objects
            $demandeur = new User();
            $demandeur->setId($echange['demandeur_id']);
            $demandeur->findById($pdo);
            $this->setDemandeur($demandeur);
            
            $receveur = new User();
            $receveur->setId($echange['receveur_id']);
            $receveur->findById($pdo);
            $this->setReceveur($receveur);
            
            $statut = new StatutEchange();
            $statut->setId($echange['statut_id']);
            $statut->findById($pdo);
            $this->setStatut($statut);
        }
    }

    public static function getAll($pdo)
    {
        $stmt = $pdo->query('SELECT * FROM v_echanges ORDER BY date_demande DESC');
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public static function getRecent($pdo, $limit = 5)
    {
        $stmt = $pdo->prepare('SELECT * FROM v_echanges ORDER BY date_demande DESC LIMIT :lim');
        $stmt->bindValue(':lim', $limit, \PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public static function countAll($pdo)
    {
        $stmt = $pdo->query('SELECT COUNT(*) FROM echanges');
        return $stmt->fetchColumn();
    }

    public static function getByUser($pdo, $userId)
    {
        $stmt = $pdo->prepare('SELECT * FROM v_echanges WHERE demandeur_id = :uid OR receveur_id = :uid2 ORDER BY date_demande DESC');
        $stmt->execute(['uid' => $userId, 'uid2' => $userId]);
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    // Récupère les échanges n'impliquant pas l'utilisateur (pour "Les échanges des autres")
    public static function getOthers($pdo, $userId)
    {
        $stmt = $pdo->prepare('SELECT * FROM v_echanges WHERE demandeur_id != :uid AND receveur_id != :uid2 ORDER BY date_demande DESC');
        $stmt->execute(['uid' => $userId, 'uid2' => $userId]);
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function accepter($pdo)
    {
        $pdo->beginTransaction();
        try {
            // 1. Accept exchange
            $stmt = $pdo->prepare('UPDATE echanges SET statut_id = 2, date_reponse = NOW() WHERE id = :id AND statut_id = 1');
            $stmt->execute(['id' => $this->getId()]);

            // 2. Get exchange objects
            $eo = new EchangeObjet();
            $eo->setEchangeId($this->getId());
            $items = $eo->findByEchangeId($pdo);

            // Load exchange to get demandeur/receveur
            $this->findById($pdo);

            foreach ($items as $item) {
                if ($item['direction'] === 'OFFERT') {
                    // Offert by demandeur -> goes to receveur
                    $stObj = $pdo->prepare('UPDATE objets SET proprietaire_id = :new_owner, statut_id = 3 WHERE id = :id');
                    $stObj->execute(['new_owner' => $this->getReceveur()->getId(), 'id' => $item['objet_id']]);

                    $hist = new HistoriqueProprietaire();
                    $hist->setObjetId($item['objet_id']);
                    $hist->setUtilisateurId($this->getReceveur()->getId());
                    $hist->setEchangeId($this->getId());
                    $hist->create($pdo);
                } else {
                    // Demande -> goes to demandeur
                    $stObj = $pdo->prepare('UPDATE objets SET proprietaire_id = :new_owner, statut_id = 3 WHERE id = :id');
                    $stObj->execute(['new_owner' => $this->getDemandeur()->getId(), 'id' => $item['objet_id']]);

                    $hist = new HistoriqueProprietaire();
                    $hist->setObjetId($item['objet_id']);
                    $hist->setUtilisateurId($this->getDemandeur()->getId());
                    $hist->setEchangeId($this->getId());
                    $hist->create($pdo);
                }
            }

            $pdo->commit();
            return true;
        } catch (\Exception $e) {
            $pdo->rollBack();
            return false;
        }
    }

    public function refuser($pdo)
    {
        $pdo->beginTransaction();
        try {
            // 1. Refuse exchange
            $stmt = $pdo->prepare('UPDATE echanges SET statut_id = 3, date_reponse = NOW() WHERE id = :id AND statut_id = 1');
            $stmt->execute(['id' => $this->getId()]);

            // 2. Restore objects availability
            $eo = new EchangeObjet();
            $eo->setEchangeId($this->getId());
            $items = $eo->findByEchangeId($pdo);

            foreach ($items as $item) {
                $stObj = $pdo->prepare('UPDATE objets SET statut_id = 1 WHERE id = :id');
                $stObj->execute(['id' => $item['objet_id']]);
            }

            $pdo->commit();
            return true;
        } catch (\Exception $e) {
            $pdo->rollBack();
            return false;
        }
    }

    public function annuler($pdo)
    {
        return $this->refuser($pdo);
    }
}