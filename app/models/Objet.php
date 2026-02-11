<?php
namespace models;

class Objet
{
    private ?int $id;
    private ?string $name;
    private ?string $description;
    private ?int $owner_id;
    private ?int $categorie_id;

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

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): void
    {
        $this->name = $name;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): void
    {
        $this->description = $description;
    }

    public function getOwnerId(): ?int
    {
        return $this->owner_id;
    }

    public function setOwnerId(?int $owner_id): void
    {
        $this->owner_id = $owner_id;
    }

    public function getCategorieId(): ?int
    {
        return $this->categorie_id;
    }

    public function setCategorieId(?int $categorie_id): void
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