<?php

namespace app\models;

class Echange
{
    private $id;
    private $objet;
    private $ownerActuel;
    private $ownerProchain;

    public function __construct($id, $objet, $ownerActuel, $ownerProchain)
    {
        $this->id = $id;
        $this->objet = $objet;
        $this->ownerActuel = $ownerActuel;
        $this->ownerProchain = $ownerProchain;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getObjet()
    {
        return $this->objet;
    }

    public function setObjet($objet)
    {
        $this->objet = $objet;
    }

    public function getOwnerActuel()
    {
        return $this->ownerActuel;
    }

    public function setOwnerActuel($ownerActuel)
    {
        $this->ownerActuel = $ownerActuel;
    }

    public function getOwnerProchain()
    {
        return $this->ownerProchain;
    }

    public function setOwnerProchain($ownerProchain)
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
