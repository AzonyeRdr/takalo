<?php
namespace app\models;

class Objet
{
    public $id;
    public $name;
    public $description;
    public $owner_id;
    public $categorie_id;

    public function __construct($id, $name, $description, $owner_id, $categorie_id)
    {
        $this->id = $id;
        $this->name = $name;
        $this->description = $description;
        $this->owner_id = $owner_id;
        $this->categorie_id = $categorie_id;
    }

    public function create($pdo)
    {
        $stmt = $pdo->prepare('INSERT INTO objets (name, description, owner_id,categorie) VALUES (:name, :description, :owner_id , :categorie_id)');
        $stmt->execute([
            'name' => $this->name,
            'description' => $this->description,
            'owner_id' => $this->owner_id,
            'categorie_id' => $this->categorie_id
        ]);
    }

    public function update($pdo)
    {
        $stmt = $pdo->prepare('UPDATE objets SET name = :name, description = :description, categorie = :categ WHERE id = :id');
        $stmt->execute([
            'name' => $this->name,
            'description' => $this->description,
            'id' => $this->id,
            'categ' => $this->categorie_id
        ]);
    }

    public function delete($pdo)
    {
        $stmt = $pdo->prepare('DELETE FROM objets WHERE id = :id');
        $stmt->execute(['id' => $this->id]);
    }

    public function findById($pdo)
    {
        $stmt = $pdo->prepare('SELECT * FROM objets WHERE id = :id');
        $stmt->execute(['id' => $this->id]);
        $obj = $stmt->fetch();
        $this->name = $obj['name'];
        $this->description = $obj['description'];
        $this->owner_id = $obj['owner_id'];
        $this->categorie_id = $obj['categorie'];
    }

}
?>