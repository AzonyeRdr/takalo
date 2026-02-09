<?php
namespace app\models;

class Categorie
{
    public $id;
    public $name;

    public function __construct($id, $name)
    {
        $this->id = $id;
        $this->name = $name;
    }

    public function create($pdo)
    {
        $stmt = $pdo->prepare('INSERT INTO categories (name) VALUES (:name)');
        $stmt->execute(['name' => $this->name]);
    }

    public function update($pdo)
    {
        $stmt = $pdo->prepare('UPDATE categories SET name = :name WHERE id = :id');
        $stmt->execute([
            'name' => $this->name,
            'id' => $this->id
        ]);
    }

    public function delete($pdo)
    {
        $stmt = $pdo->prepare('DELETE FROM categories WHERE id = :id');
        $stmt->execute(['id' => $this->id]);
    }

    public function findById($pdo)
    {
        $stmt = $pdo->prepare('SELECT * FROM categories WHERE id = :id');
        $stmt->execute(['id' => $this->id]);
        $cat = $stmt->fetch();
        $this->name = $cat['name'];
    }
}