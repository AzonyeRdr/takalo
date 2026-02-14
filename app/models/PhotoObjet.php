<?php
namespace models;

class PhotoObjet
{
    private ?int $id;
    private ?int $objetId;
    private ?string $chemin;
    private ?int $ordre;
    private ?bool $estPrincipale;

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

    public function getObjetId(): ?int
    {
        return $this->objetId;
    }

    public function setObjetId(?int $objetId): void
    {
        $this->objetId = $objetId;
    }

    public function getChemin(): ?string
    {
        return $this->chemin;
    }

    public function setChemin(?string $chemin): void
    {
        $this->chemin = $chemin;
    }

    public function getOrdre(): ?int
    {
        return $this->ordre;
    }

    public function setOrdre(?int $ordre): void
    {
        $this->ordre = $ordre;
    }

    public function getEstPrincipale(): ?bool
    {
        return $this->estPrincipale;
    }

    public function setEstPrincipale(?bool $estPrincipale): void
    {
        $this->estPrincipale = $estPrincipale;
    }

    public function create($pdo)
    {
        $stmt = $pdo->prepare('INSERT INTO photos_objet (objet_id, chemin, ordre, est_principale) VALUES (:objet_id, :chemin, :ordre, :est_principale)');
        $stmt->execute([
            'objet_id' => $this->getObjetId(),
            'chemin' => $this->getChemin(),
            'ordre' => $this->getOrdre(),
            'est_principale' => $this->getEstPrincipale() ? 1 : 0
        ]);
        $this->setId($pdo->lastInsertId());
    }

    public function update($pdo)
    {
        $stmt = $pdo->prepare('UPDATE photos_objet SET objet_id = :objet_id, chemin = :chemin, ordre = :ordre, est_principale = :est_principale WHERE id = :id');
        $stmt->execute([
            'objet_id' => $this->getObjetId(),
            'chemin' => $this->getChemin(),
            'ordre' => $this->getOrdre(),
            'est_principale' => $this->getEstPrincipale() ? 1 : 0,
            'id' => $this->getId()
        ]);
    }

    public function delete($pdo)
    {
        $stmt = $pdo->prepare('DELETE FROM photos_objet WHERE id = :id');
        $stmt->execute(['id' => $this->getId()]);
    }

    public function findById($pdo)
    {
        $stmt = $pdo->prepare('SELECT * FROM photos_objet WHERE id = :id');
        $stmt->execute(['id' => $this->getId()]);
        $photo = $stmt->fetch();
        if ($photo) {
            $this->setObjetId($photo['objet_id']);
            $this->setChemin($photo['chemin']);
            $this->setOrdre($photo['ordre']);
            $this->setEstPrincipale($photo['est_principale']);
        }
    }

    public static function getAllByObjet($pdo, $objet)
    {
        $stmt = $pdo->prepare('SELECT * FROM photos_objet WHERE objet_id = :objet_id ORDER BY est_principale DESC, ordre ASC');
        $stmt->execute(['objet_id' => $objet->getId()]);
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public static function getPrincipaleByObjet($pdo, $objet)
    {
        $stmt = $pdo->prepare('SELECT * FROM photos_objet WHERE objet_id = :objet_id AND est_principale = 1 LIMIT 1');
        $stmt->execute(['objet_id' => $objet->getId()]);
        return $stmt->fetch();
    }

    public static function deleteAllByObjet($pdo, $objet)
    {
        $stmt = $pdo->prepare('DELETE FROM photos_objet WHERE objet_id = :objet_id');
        $stmt->execute(['objet_id' => $objet->getId()]);
    }
}