<?php

namespace app\models;

class User
{
    private $id;
    private $name;
    private $email;
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
        $stmt = $pdo->prepare('INSERT INTO user (name, email, role) VALUES (:name, :email, :role)');
        $stmt->execute([
            'name' => $this->getName(),
            'email' => $this->getEmail(),
            'role' => $this->getRole()
        ]);
        $this->setId($pdo->lastInsertId());
    }

    public function delete($pdo)
    {
        if ($this->getId()) {
            $stmt = $pdo->prepare('DELETE FROM user WHERE id = :id');
            $stmt->execute(['id' => $this->getId()]);
            $this->setId(null);
        }
    }

    public function findById($pdo)
    {
        $stmt = $pdo->prepare('SELECT * FROM user WHERE id = :id');
        $stmt->execute(['id' => $this->getId()]);
        $row = $stmt->fetch();
        $this->setName($row['name']);
        $this->setEmail($row['email']);
        $this->setRole($row['role']);
    }

    public function update($pdo)
    {
        $stmt = $pdo->prepare('UPDATE user SET name = :name, email = :email, role = :role WHERE id = :id');
        $stmt->execute([
            'id' => $this->getId(),
            'name' => $this->getName(),
            'email' => $this->getEmail(),
            'role' => $this->getRole()
        ]);
    }

    public function isAdmin()
    {
        return $this->role === 'admin';
    }

}
