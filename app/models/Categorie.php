<?php
namespace models;

class Categorie
{
    private ?int $id;
    private ?string $libelle;
    private ?string $symbole;
    private ?string $description;

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

    public function getLibelle(): ?string
    {
        return $this->libelle;
    }

    public function setLibelle(?string $libelle): void
    {
        $this->libelle = $libelle;
    }

    public function getSymbole(): ?string
    {
        return $this->symbole;
    }

    public function setSymbole(?string $symbole): void
    {
        $this->symbole = $symbole;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): void
    {
        $this->description = $description;
    }

    public function create($pdo)
    {
        $stmt = $pdo->prepare('INSERT INTO categories (libelle, symbole, description) VALUES (:libelle, :symbole, :description)');
        $stmt->execute([
            'libelle' => $this->getLibelle(),
            'symbole' => $this->getSymbole(),
            'description' => $this->getDescription()
        ]);
        $this->setId($pdo->lastInsertId());
    }

    public function update($pdo)
    {
        $stmt = $pdo->prepare('UPDATE categories SET libelle = :libelle, symbole = :symbole, description = :description WHERE id = :id');
        $stmt->execute([
            'libelle' => $this->getLibelle(),
            'symbole' => $this->getSymbole(),
            'description' => $this->getDescription(),
            'id' => $this->getId()
        ]);
    }

    public function delete($pdo)
    {
        $stmt = $pdo->prepare('DELETE FROM categories WHERE id = :id');
        $stmt->execute(['id' => $this->getId()]);
    }

    public function findById($pdo)
    {
        $stmt = $pdo->prepare('SELECT * FROM categories WHERE id = :id');
        $stmt->execute(['id' => $this->getId()]);
        $cat = $stmt->fetch();
        if ($cat) {
            $this->setLibelle($cat['libelle']);
            $this->setSymbole($cat['symbole']);
            $this->setDescription($cat['description']);
        }
    }

    public static function getAll($pdo)
    {
        $stmt = $pdo->query('SELECT * FROM categories ORDER BY libelle ASC');
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }
}