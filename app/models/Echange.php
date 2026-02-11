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
        $stmt = $pdo->query('SELECT e.*, 
                             u1.nom as demandeur_nom,
                             u2.nom as receveur_nom,
                             se.libelle as statut
                             FROM echanges e
                             JOIN utilisateurs u1 ON u1.id = e.demandeur_id
                             JOIN utilisateurs u2 ON u2.id = e.receveur_id
                             JOIN statuts_echange se ON se.id = e.statut_id
                             ORDER BY e.date_demande DESC');
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public static function getRecent($pdo, $limit = 5)
    {
        $stmt = $pdo->prepare('SELECT e.*, 
                               u1.nom as demandeur_nom,
                               u2.nom as receveur_nom,
                               se.libelle as statut
                               FROM echanges e
                               JOIN utilisateurs u1 ON u1.id = e.demandeur_id
                               JOIN utilisateurs u2 ON u2.id = e.receveur_id
                               JOIN statuts_echange se ON se.id = e.statut_id
                               ORDER BY e.date_demande DESC
                               LIMIT :limit');
        $stmt->bindValue(':limit', $limit, \PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public static function countAll($pdo)
    {
        $stmt = $pdo->query('SELECT COUNT(*) FROM echanges');
        return $stmt->fetchColumn();
    }

    public static function countByStatut($pdo, $code)
    {
        $stmt = $pdo->prepare('SELECT COUNT(*) FROM echanges e
                               JOIN statuts_echange se ON se.id = e.statut_id
                               WHERE se.code = :code');
        $stmt->execute(['code' => $code]);
        return $stmt->fetchColumn();
    }

    public static function getByUser($pdo, $userId)
    {
        $stmt = $pdo->prepare('SELECT e.*, 
                               u1.nom as demandeur_nom,
                               u2.nom as receveur_nom,
                               se.libelle as statut
                               FROM echanges e
                               JOIN utilisateurs u1 ON u1.id = e.demandeur_id
                               JOIN utilisateurs u2 ON u2.id = e.receveur_id
                               JOIN statuts_echange se ON se.id = e.statut_id
                               WHERE e.demandeur_id = :userId OR e.receveur_id = :userId
                               ORDER BY e.date_demande DESC');
        $stmt->execute(['userId' => $userId]);
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }
}