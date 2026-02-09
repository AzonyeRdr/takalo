<?php

namespace app\models;

class Echange
{
    private ?int $id;
    private ?Objet $objet;
    private ?User $ownerActuel;
    private ?User $ownerProchain;

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

    public function getObjet(): ?Objet
    {
        return $this->objet;
    }

    public function setObjet(?Objet $objet): void
    {
        $this->objet = $objet;
    }

    public function getOwnerActuel(): ?User
    {
        return $this->ownerActuel;
    }

    public function setOwnerActuel(?User $ownerActuel): void
    {
        $this->ownerActuel = $ownerActuel;
    }

    public function getOwnerProchain(): ?User
    {
        return $this->ownerProchain;
    }

    public function setOwnerProchain(?User $ownerProchain): void
    {
        $this->ownerProchain = $ownerProchain;
    }

    public function create($pdo)
    {
        $stmt = $pdo->prepare('INSERT INTO echanges (objet_id, owner_actuel_id, owner_prochain_id) VALUES (:objet_id, :owner_actuel_id, :owner_prochain_id)');
        $stmt->execute([
            'objet_id' => $this->getObjet()->getId(),
            'owner_actuel_id' => $this->getOwnerActuel()->getId(),
            'owner_prochain_id' => $this->getOwnerProchain()->getId()
        ]);
    }

    public function update($pdo)
    {
        $stmt = $pdo->prepare('UPDATE echanges SET objet_id = :objet_id, owner_actuel_id = :owner_actuel_id, owner_prochain_id = :owner_prochain_id WHERE id = :id');
        $stmt->execute([
            'objet_id' => $this->getObjet()->getId(),
            'owner_actuel_id' => $this->getOwnerActuel()->getId(),
            'owner_prochain_id' => $this->getOwnerProchain()->getId(),
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
        $this->setObjet($echange['objet_id']);
        $this->setOwnerActuel($echange['owner_actuel_id']);
        $this->setOwnerProchain($echange['owner_prochain_id']);
    }
}
