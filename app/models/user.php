<?php

namespace app\models;

class User
{
    public $id;
    public $name;
    public $email;
    private $role;

    public function __construct($id, $name, $email, $role)
    {
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
        $this->role = $role;
    }
    
    public function setName($name)
    {
        $this->name = $name;
    }
    public function getName()
    {
        return $this->name;
    }
    public function setEmail($email)
    {
        $this->email = $email;
    }
    public function getEmail()
    {
        return $this->email;
    }
    public function getId()
    {
        return $this->id;
    }
    public function setId($id)
    {
        $this->id = $id;
    }
    public function setRole($role)
    {
        $this->role = $role;
    }
    public function getRole()
    {
        return $this->role;
    }


    public function create($pdo)
    {
        $stmt = $pdo->prepare('INSERT INTO users (name, email, role) VALUES (:name, :email, :role)');
        $stmt->execute([
            'name' => $this->name,
            'email' => $this->email,
            'role' => $this->role
        ]);
        $this->id = $pdo->lastInsertId();
    }

    public function delete($pdo)
    {
        if ($this->id) {
            $stmt = $pdo->prepare('DELETE FROM users WHERE id = :id');
            $stmt->execute(['id' => $this->id]);
            $this->id = null;
        }
    }

    public function findById($pdo)
    {
        $stmt = $pdo->prepare('SELECT * FROM users WHERE id = :id');
        $stmt->execute(['id' => $this->id]);
        $stmt->fetch();
        $this->name = $stmt->name;
        $this->email = $stmt->email;
        $this->role = $stmt->role;
    }

    public function update($pdo)
    {
        $stmt = $pdo->prepare('UPDATE users SET name = :name, email = :email, role = :role WHERE id = :id');
        $stmt->execute([
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'role' => $this->role
        ]);
    }
}
