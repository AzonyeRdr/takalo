<?php

namespace app\models;

class Echange
{
    public $id;
    public $objet;
    public $ownerActuel;
    public $ownerProchain;

    public function __construct($id, $objet, $ownerActuel, $ownerProchain)
    {
        $this->id = $id;
        $this->objet = $objet;
        $this->ownerActuel = $ownerActuel;
        $this->ownerProchain = $ownerProchain;
    }

    public function create($pdo)
    {
        $stmt = $pdo->prepare('INSERT INTO echanges (objet_id, owner_actuel_id, owner_prochain_id) VALUES (:objet_id, :owner_actuel_id, :owner_prochain_id)');
        $stmt->execute([
            'objet_id' => $this->objet->id,
            'owner_actuel_id' => $this->ownerActuel->id,
            'owner_prochain_id' => $this->ownerProchain->id
        ]);
    }

    public function update($pdo)
    {
        $stmt = $pdo->prepare('UPDATE echanges SET objet_id = :objet_id, owner_actuel_id = :owner_actuel_id, owner_prochain_id = :owner_prochain_id WHERE id = :id');
        $stmt->execute([
            'objet_id' => $this->objet->id,
            'owner_actuel_id' => $this->ownerActuel->id,
            'owner_prochain_id' => $this->ownerProchain->id,
            'id' => $this->id
        ]);
    }

    public function delete($pdo)
    {
        $stmt = $pdo->prepare('DELETE FROM echanges WHERE id = :id');
        $stmt->execute(['id' => $this->id]);
    }

    public function findById($pdo)
    {
        $stmt = $pdo->prepare('SELECT * FROM echanges WHERE id = :id');
        $stmt->execute(['id' => $this->id]);
        $echange = $stmt->fetch();
        $this->objet = $echange['objet_id'];
        $this->ownerActuel = $echange['owner_actuel_id'];
        $this->ownerProchain = $echange['owner_prochain_id'];
    }
}
