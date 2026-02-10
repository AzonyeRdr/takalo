<?php

namespace app\models;

class User
{
    private ?int $id;
    private ?string $name;
    private ?string $email;
    private ?string $role;

    public function __construct()
    {
    }

    public function setName(?string $name): void
    {
        $this->name = $name;
    }
    public function getName(): ?string
    {
        return $this->name;
    }
    public function setEmail(?string $email): void
    {
        $this->email = $email;
    }
    public function getEmail(): ?string
    {
        return $this->email;
    }
    public function getId(): ?int
    {
        return $this->id;
    }
    public function setId(?int $id): void
    {
        $this->id = $id;
    }
    public function setRole(?string $role): void
    {
        $this->role = $role;
    }
    public function getRole(): ?string
    {
        return $this->role;
    }


    public function create($pdo)
    {
        $stmt = $pdo->prepare("INSERT INTO user (name, email, role) VALUES (:name, :email, :role)");
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
            $stmt = $pdo->prepare("DELETE FROM user WHERE id = :id");
            $stmt->execute(['id' => $this->getId()]);
            $this->setId(null);
        }
    }

    public function findById($pdo)
    {
        $stmt = $pdo->prepare("SELECT * FROM user WHERE id = :id");
        $stmt->execute(['id' => $this->getId()]);
        $row = $stmt->fetch();
        $this->setName($row['name']);
        $this->setEmail($row['email']);
        $this->setRole($row['role']);
    }

    public function update($pdo)
    {
        $stmt = $pdo->prepare("UPDATE user SET name = :name, email = :email, role = :role WHERE id = :id");
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
