<?php
namespace models;

class EchangeObjet
{
    private ?int $id = null;
    private ?int $echangeId = null;
    private ?int $objetId = null;
    private ?string $direction = null;

    public function __construct() {}

    public function getId(): ?int { return $this->id; }
    public function setId(?int $id): void { $this->id = $id; }

    public function getEchangeId(): ?int { return $this->echangeId; }
    public function setEchangeId(?int $echangeId): void { $this->echangeId = $echangeId; }

    public function getObjetId(): ?int { return $this->objetId; }
    public function setObjetId(?int $objetId): void { $this->objetId = $objetId; }

    public function getDirection(): ?string { return $this->direction; }
    public function setDirection(?string $direction): void { $this->direction = $direction; }

    public function create($pdo)
    {
        $stmt = $pdo->prepare('INSERT INTO echange_objets (echange_id, objet_id, direction) VALUES (:echange_id, :objet_id, :direction)');
        $stmt->execute([
            'echange_id' => $this->getEchangeId(),
            'objet_id' => $this->getObjetId(),
            'direction' => $this->getDirection()
        ]);
        $this->setId($pdo->lastInsertId());
    }

    public function delete($pdo)
    {
        $stmt = $pdo->prepare('DELETE FROM echange_objets WHERE id = :id');
        $stmt->execute(['id' => $this->getId()]);
    }

    public function findByEchangeId($pdo)
    {
        $stmt = $pdo->prepare('SELECT * FROM v_echange_objets WHERE echange_id = :echange_id');
        $stmt->execute(['echange_id' => $this->getEchangeId()]);
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function deleteByEchangeId($pdo)
    {
        $stmt = $pdo->prepare('DELETE FROM echange_objets WHERE echange_id = :echange_id');
        $stmt->execute(['echange_id' => $this->getEchangeId()]);
    }
}
