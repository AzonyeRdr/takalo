<?php
namespace models;

class Objet
{
    private ?int $id;
    private ?string $titre;
    private ?string $description;
    private ?User $proprietaire;
    private ?Categorie $categorie;
    private ?Etat $etat;
    private ?Statut $statut;
    private ?float $prix_estime;
    private ?string $photo_principale;

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

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(?string $titre): void
    {
        $this->titre = $titre;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): void
    {
        $this->description = $description;
    }

    public function getProprietaire(): ?User
    {
        return $this->proprietaire;
    }

    public function setProprietaire(?User $proprietaire): void
    {
        $this->proprietaire = $proprietaire;
    }

    public function getCategorie(): ?Categorie
    {
        return $this->categorie;
    }

    public function setCategorie(?Categorie $categorie): void
    {
        $this->categorie = $categorie;
    }

    public function getEtat(): ?Etat
    {
        return $this->etat;
    }

    public function setEtat(?Etat $etat): void
    {
        $this->etat = $etat;
    }

    public function getStatut(): ?Statut
    {
        return $this->statut;
    }

    public function setStatut(?Statut $statut): void
    {
        $this->statut = $statut;
    }

    public function getPrixEstime(): ?float
    {
        return $this->prix_estime;
    }

    public function setPrixEstime(?float $prix_estime): void
    {
        $this->prix_estime = $prix_estime;
    }

    public function getPhotoPrincipale(): ?string
    {
        return $this->photo_principale;
    }

    public function setPhotoPrincipale(?string $photo_principale): void
    {
        $this->photo_principale = $photo_principale;
    }

    public function create($pdo)
    {
        $stmt = $pdo->prepare('INSERT INTO objets (titre, description, proprietaire_id, categorie_id, etat_id, statut_id, prix_estime) VALUES (:titre, :description, :proprietaire_id, :categorie_id, :etat_id, :statut_id, :prix_estime)');
        $stmt->execute([
            'titre' => $this->getTitre(),
            'description' => $this->getDescription(),
            'proprietaire_id' => $this->getProprietaire()->getId(),
            'categorie_id' => $this->getCategorie()->getId(),
            'etat_id' => $this->getEtat()->getId(),
            'statut_id' => $this->getStatut()->getId(),
            'prix_estime' => $this->getPrixEstime()
        ]);
        $this->setId($pdo->lastInsertId());
    }

    public function update($pdo)
    {
        $stmt = $pdo->prepare('UPDATE objets SET titre = :titre, description = :description, categorie_id = :categorie_id, etat_id = :etat_id, statut_id = :statut_id, prix_estime = :prix_estime WHERE id = :id');
        $stmt->execute([
            'titre' => $this->getTitre(),
            'description' => $this->getDescription(),
            'categorie_id' => $this->getCategorie()->getId(),
            'etat_id' => $this->getEtat()->getId(),
            'statut_id' => $this->getStatut()->getId(),
            'prix_estime' => $this->getPrixEstime(),
            'id' => $this->getId()
        ]);
    }

    public function delete($pdo)
    {
        $stmt = $pdo->prepare('UPDATE objets SET deleted_at = NOW() WHERE id = :id');
        $stmt->execute(['id' => $this->getId()]);
    }

    public function findById($pdo)
    {
        $stmt = $pdo->prepare('SELECT o.*, po.chemin as photo_principale 
                               FROM objets o 
                               LEFT JOIN photos_objet po ON po.objet_id = o.id AND po.est_principale = 1 
                               WHERE o.id = :id AND o.deleted_at IS NULL');
        $stmt->execute(['id' => $this->getId()]);
        $obj = $stmt->fetch();
        if ($obj) {
            $this->setTitre($obj['titre']);
            $this->setDescription($obj['description']);
            $this->setPrixEstime($obj['prix_estime']);
            $this->setPhotoPrincipale($obj['photo_principale']);
            
            // Load related objects
            $proprietaire = new User();
            $proprietaire->setId($obj['proprietaire_id']);
            $proprietaire->findById($pdo);
            $this->setProprietaire($proprietaire);
            
            $categorie = new Categorie();
            $categorie->setId($obj['categorie_id']);
            $categorie->findById($pdo);
            $this->setCategorie($categorie);
            
            $etat = new Etat();
            $etat->setId($obj['etat_id']);
            $etat->findById($pdo);
            $this->setEtat($etat);
            
            $statut = new Statut();
            $statut->setId($obj['statut_id']);
            $statut->findById($pdo);
            $this->setStatut($statut);
        }
    }

    public static function getRecentObjets($pdo, $limit = 6)
    {
        $stmt = $pdo->prepare('SELECT o.*, po.chemin as photo_principale, c.libelle as categorie_nom, u.nom as proprietaire_nom
                               FROM objets o 
                               LEFT JOIN photos_objet po ON po.objet_id = o.id AND po.est_principale = 1 
                               LEFT JOIN categories c ON c.id = o.categorie_id
                               LEFT JOIN utilisateurs u ON u.id = o.proprietaire_id
                               WHERE o.deleted_at IS NULL AND o.statut_id = 1
                               ORDER BY o.created_at DESC 
                               LIMIT :limit');
        $stmt->bindValue(':limit', $limit, \PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public static function countAll($pdo)
    {
        $stmt = $pdo->query('SELECT COUNT(*) FROM objets WHERE deleted_at IS NULL');
        return $stmt->fetchColumn();
    }

    public static function countDisponibles($pdo)
    {
        $stmt = $pdo->query('SELECT COUNT(*) FROM objets WHERE deleted_at IS NULL AND statut_id = 1');
        return $stmt->fetchColumn();
    }
}