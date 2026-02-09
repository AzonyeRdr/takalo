<?php
namespace app\models;

class Objet
{
    private $id;
    private $name;
    private $description;
    private $owner_id;
    private $categorie_id;

    public function __construct($id, $name, $description, $owner_id, $categorie_id)
    {
        $this->id = $id;
        $this->name = $name;
        $this->description = $description;
        $this->owner_id = $owner_id;
        $this->categorie_id = $categorie_id;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function setDescription($description)
    {
        $this->description = $description;
    }

    public function getOwnerId()
    {
        return $this->owner_id;
    }

    public function setOwnerId($owner_id)
    {
        $this->owner_id = $owner_id;
    }

    public function getCategorieId()
    {
        return $this->categorie_id;
    }

    public function setCategorieId($categorie_id)
    {
        $this->categorie_id = $categorie_id;
    }

    public function create($pdo)
    {
        $stmt = $pdo->prepare('INSERT INTO objets (name, description, owner_id,categorie) VALUES (:name, :description, :owner_id , :categorie_id)');
        $stmt->execute([
            'name' => $this->getName(),
            'description' => $this->getDescription(),
            'owner_id' => $this->getOwnerId(),
            'categorie_id' => $this->getCategorieId()
        ]);
    }

    public function update($pdo)
    {
        $stmt = $pdo->prepare('UPDATE objets SET name = :name, description = :description, categorie = :categ WHERE id = :id');
        $stmt->execute([
            'name' => $this->getName(),
            'description' => $this->getDescription(),
            'id' => $this->getId(),
            'categ' => $this->getCategorieId()
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
        $this->setName($obj['name']);
        $this->setDescription($obj['description']);
        $this->setOwnerId($obj['owner_id']);
        $this->setCategorieId($obj['categorie']);
    }

}
?>