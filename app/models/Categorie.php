<?php
namespace models;

class Categorie
{
    private ?int $id;
    private ?string $libelle;
    private ?string $symbole;
    private ?string $created_at;

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

    public function getCreatedAt(): ?string
    {
        return $this->created_at;
    }

    public function setCreatedAt(?string $created_at): void
    {
        $this->created_at = $created_at;
    }

    public function create($pdo)
    {
        $stmt = $pdo->prepare('INSERT INTO categories (libelle, symbole) VALUES (:libelle, :symbole)');
        $stmt->execute([
            'libelle' => $this->getLibelle(),
            'symbole' => $this->getSymbole()
        ]);
        $this->setId($pdo->lastInsertId());
    }

    public function update($pdo)
    {
        $stmt = $pdo->prepare('UPDATE categories SET libelle = :libelle, symbole = :symbole WHERE id = :id');
        $stmt->execute([
            'libelle' => $this->getLibelle(),
            'symbole' => $this->getSymbole(),
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
            $this->setCreatedAt($cat['created_at']);
        }
    }

    public static function getAll($pdo)
    {
        $stmt = $pdo->query('SELECT * FROM categories ORDER BY libelle ASC');
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public static function getAllWithCount($pdo)
    {
        $stmt = $pdo->query('SELECT c.*, COUNT(o.id) as objet_count 
                             FROM categories c 
                             LEFT JOIN objets o ON o.categorie_id = c.id AND o.deleted_at IS NULL 
                             GROUP BY c.id');
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public static function getStats($pdo)
    {
        $stmt = $pdo->query('SELECT c.libelle, COUNT(o.id) as count 
                             FROM categories c 
                             LEFT JOIN objets o ON o.categorie_id = c.id AND o.deleted_at IS NULL 
                             GROUP BY c.id');
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }
}