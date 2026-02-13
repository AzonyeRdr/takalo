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
    private array $photos;

    public function __construct()
    {
        $this->photos = [];
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

    public function setPhotos(array $photos): void
    {
        $this->photos = $photos;
    }

    public function addPhoto(PhotoObjet $photo): void
    {
        $this->photos[] = $photo;
    }

    public function removePhoto(PhotoObjet $photo): void
    {
        $key = array_search($photo, $this->photos, true);
        if ($key !== false) {
            unset($this->photos[$key]);
            $this->photos = array_values($this->photos); // Reindex array
        }
    }

    public function getPhotoPrincipale(): ?PhotoObjet
    {
        foreach ($this->photos as $photo) {
            if ($photo->getEstPrincipale()) {
                return $photo;
            }
        }
        return $this->photos[0] ?? null;
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
        $stmt = $pdo->prepare('DELETE FROM objets WHERE id = :id');
        $stmt->execute(['id' => $this->getId()]);
    }

    public function findById($pdo)
    {
        $stmt = $pdo->prepare('SELECT * FROM objets WHERE id = :id');
        $stmt->execute(['id' => $this->getId()]);
        $obj = $stmt->fetch();
        if ($obj) {
            $this->setTitre($obj['titre']);
            $this->setDescription($obj['description']);
            $this->setPrixEstime($obj['prix_estime']);

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

            // Load photos
            $this->loadPhotos($pdo);
        }
    }

    public function getPhotos()
    {
        return $this->photos;
    }

    public function loadPhotos($pdo)
    {
        $photosData = PhotoObjet::getAllByObjet($pdo, $this);
        $this->photos = [];
        foreach ($photosData as $photoData) {
            $photo = new PhotoObjet();
            $photo->setId($photoData['id']);
            $photo->setObjetId($photoData['objet_id']);
            $photo->setChemin($photoData['chemin']);
            $photo->setOrdre($photoData['ordre']);
            $photo->setEstPrincipale($photoData['est_principale']);
            $this->addPhoto($photo);
        }
    }

    private function buildFromRow($pdo, $row)
    {
        $this->setId($row['id']);
        $this->setTitre($row['titre']);
        $this->setDescription($row['description']);
        $this->setPrixEstime($row['prix_estime']);

        $proprietaire = new User();
        $proprietaire->setId($row['proprietaire_id']);
        $proprietaire->findById($pdo);
        $this->setProprietaire($proprietaire);

        $categorie = new Categorie();
        $categorie->setId($row['categorie_id']);
        $categorie->findById($pdo);
        $this->setCategorie($categorie);

        $etat = new Etat();
        $etat->setId($row['etat_id']);
        $etat->findById($pdo);
        $this->setEtat($etat);

        $statut = new Statut();
        $statut->setId($row['statut_id']);
        $statut->findById($pdo);
        $this->setStatut($statut);

        $this->loadPhotos($pdo);
    }

    private function buildFromRowWithoutPhotos($pdo, $row)
    {
        $this->setId($row['id']);
        $this->setTitre($row['titre']);
        $this->setDescription($row['description']);
        $this->setPrixEstime($row['prix_estime']);

        $proprietaire = new User();
        $proprietaire->setId($row['proprietaire_id']);
        $proprietaire->findById($pdo);
        $this->setProprietaire($proprietaire);

        $categorie = new Categorie();
        $categorie->setId($row['categorie_id']);
        $categorie->findById($pdo);
        $this->setCategorie($categorie);

        $etat = new Etat();
        $etat->setId($row['etat_id']);
        $etat->findById($pdo);
        $this->setEtat($etat);

        $statut = new Statut();
        $statut->setId($row['statut_id']);
        $statut->findById($pdo);
        $this->setStatut($statut);

        // No loadPhotos here
    }

    public static function getAllWithLimits($pdo, $limit)
    {
        $stmt = $pdo->prepare('SELECT * FROM objets ORDER BY id DESC LIMIT ' . (int)$limit);
        $stmt->execute();
        $objets = [];
        while ($row = $stmt->fetch()) {
            $objet = new Objet();
            $objet->buildFromRow($pdo, $row);
            $objets[] = $objet;
        }
        return $objets;
    }

    public static function getAll($pdo)
    {
        $stmt = $pdo->query('SELECT * FROM objets ORDER BY id DESC');
        $objets = [];
        while ($row = $stmt->fetch()) {
            $objet = new Objet();
            $objet->buildFromRow($pdo, $row);
            $objets[] = $objet;
        }
        return $objets;
    }

    public function getAllByUser($pdo)
    {
        $stmt = $pdo->prepare('SELECT * FROM objets WHERE proprietaire_id = :user_id ORDER BY id DESC');
        $stmt->execute(['user_id' => $this->getProprietaire()->getId()]);
        $objets = [];
        $objetIds = [];
        while ($row = $stmt->fetch()) {
            $objet = new Objet();
            $objet->buildFromRowWithoutPhotos($pdo, $row);
            $objets[] = $objet;
            $objetIds[] = $objet->getId();
        }

        // Batch load photos for all objects
        if (!empty($objetIds)) {
            $placeholders = str_repeat('?,', count($objetIds) - 1) . '?';
            $photoStmt = $pdo->prepare("SELECT * FROM photos_objet WHERE objet_id IN ($placeholders) ORDER BY objet_id, est_principale DESC, ordre ASC");
            $photoStmt->execute($objetIds);
            $photosByObjet = [];
            while ($photoRow = $photoStmt->fetch()) {
                $photosByObjet[$photoRow['objet_id']][] = $photoRow;
            }

            foreach ($objets as $objet) {
                $objetId = $objet->getId();
                if (isset($photosByObjet[$objetId])) {
                    foreach ($photosByObjet[$objetId] as $photoData) {
                        $photo = new PhotoObjet();
                        $photo->setId($photoData['id']);
                        $photo->setObjetId($photoData['objet_id']);
                        $photo->setChemin($photoData['chemin']);
                        $photo->setOrdre($photoData['ordre']);
                        $photo->setEstPrincipale($photoData['est_principale']);
                        $objet->addPhoto($photo);
                    }
                }
            }
        }

        return $objets;
    }

    /**
     * Convenience static method — retourne les objets d'un utilisateur donné.
     * Usage : Objet::getObjetsOf(
     *            $pdo, $userInstance
     *         );
     */
    public static function getObjetsOf($pdo, User $user)
    {
        $objet = new Objet();
        $objet->setProprietaire($user);
        return $objet->getAllByUser($pdo);
    }

    /**
     * Retourne les objets d'un utilisateur **sans** charger les photos (pour rendu rapide / diagnostics).
     * Utile pour les pages listant des objets où les images ne doivent pas être fetchées.
     */
    public static function getObjetsOfWithoutPhotos($pdo, User $user)
    {
        $stmt = $pdo->prepare('SELECT * FROM objets WHERE proprietaire_id = :user_id ORDER BY id DESC');
        $stmt->execute(['user_id' => $user->getId()]);
        $objets = [];
        while ($row = $stmt->fetch()) {
            $objet = new Objet();
            // buildFromRowWithoutPhotos évite tout chargement de photos
            $objet->buildFromRowWithoutPhotos($pdo, $row);
            $objets[] = $objet;
        }
        return $objets;
    }

    public function getAllByUserDisponible($pdo)
    {
        $stmt = $pdo->prepare('SELECT * FROM objets WHERE proprietaire_id = :user_id AND statut_id = 1 ORDER BY id DESC');
        $stmt->execute(['user_id' => $this->getProprietaire()->getId()]);
        $objets = [];
        $objetIds = [];
        while ($row = $stmt->fetch()) {
            $objet = new Objet();
            $objet->buildFromRowWithoutPhotos($pdo, $row);
            $objets[] = $objet;
            $objetIds[] = $objet->getId();
        }

        // Batch load photos for all objects
        if (!empty($objetIds)) {
            $placeholders = str_repeat('?,', count($objetIds) - 1) . '?';
            $photoStmt = $pdo->prepare("SELECT * FROM photos_objet WHERE objet_id IN ($placeholders) ORDER BY objet_id, est_principale DESC, ordre ASC");
            $photoStmt->execute($objetIds);
            $photosByObjet = [];
            while ($photoRow = $photoStmt->fetch()) {
                $photosByObjet[$photoRow['objet_id']][] = $photoRow;
            }

            foreach ($objets as $objet) {
                $objetId = $objet->getId();
                if (isset($photosByObjet[$objetId])) {
                    foreach ($photosByObjet[$objetId] as $photoData) {
                        $photo = new PhotoObjet();
                        $photo->setId($photoData['id']);
                        $photo->setObjetId($photoData['objet_id']);
                        $photo->setChemin($photoData['chemin']);
                        $photo->setOrdre($photoData['ordre']);
                        $photo->setEstPrincipale($photoData['est_principale']);
                        $objet->addPhoto($photo);
                    }
                }
            }
        }

        return $objets;
    }

    public static function search($pdo, $keyword = null, $categorieId = null)
    {
        $sql = 'SELECT * FROM objets WHERE 1=1';
        $params = [];

        if ($keyword !== null && $keyword !== '') {
            $sql .= ' AND titre LIKE :keyword';
            $params['keyword'] = '%' . $keyword . '%';
        }

        if ($categorieId !== null && $categorieId !== '' && $categorieId != 0) {
            $sql .= ' AND categorie_id = :categorie_id';
            $params['categorie_id'] = $categorieId;
        }

        $sql .= ' ORDER BY id DESC';

        $stmt = $pdo->prepare($sql);
        $stmt->execute($params);
        $objets = [];
        while ($row = $stmt->fetch()) {
            $objet = new Objet();
            $objet->buildFromRow($pdo, $row);
            $objets[] = $objet;
        }
        return $objets;
    }

    public static function countAll($pdo)
    {
        $stmt = $pdo->query('SELECT COUNT(*) FROM objets');
        return $stmt->fetchColumn();
    }
}