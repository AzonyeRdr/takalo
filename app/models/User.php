<?php

namespace models;

class User
{
    private ?int $id;
    private ?string $nom;
    private ?string $email;
    private ?string $password_hash;
    private ?int $role_id;
    private ?string $tel;

    public function __construct() {}

    public function setNom(?string $nom): void
    {
        $this->nom = $nom;
    }
    public function getNom(): ?string
    {
        return $this->nom;
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
    public function setPasswordHash(?string $password_hash): void
    {
        $this->password_hash = $password_hash;
    }
    public function getPasswordHash(): ?string
    {
        return $this->password_hash;
    }
    public function setRoleId(?int $role_id): void
    {
        $this->role_id = $role_id;
    }
    public function getRoleId(): ?int
    {
        return $this->role_id;
    }
    public function setTel(?string $tel): void
    {
        $this->tel = $tel;
    }
    public function getTel(): ?string
    {
        return $this->tel;
    }


    public function create($pdo)
    {
        $stmt = $pdo->prepare("INSERT INTO utilisateurs (nom, email, password_hash, role_id, tel) VALUES (:nom, :email, :password_hash, :role_id, :tel)");
        $stmt->execute([
            'nom' => $this->getNom(),
            'email' => $this->getEmail(),
            'password_hash' => $this->getPasswordHash(),
            'role_id' => $this->getRoleId(),
            'tel' => $this->getTel()
        ]);
        $this->setId($pdo->lastInsertId());
    }

    public function delete($pdo)
    {
        if ($this->getId()) {
            $stmt = $pdo->prepare("DELETE FROM utilisateurs WHERE id = :id");
            $stmt->execute(['id' => $this->getId()]);
            $this->setId(null);
        }
    }

    public function findByMail($pdo)
    {
        $stmt = $pdo->prepare("SELECT * FROM utilisateurs WHERE id = :id");
        $stmt->execute(['id' => $this->getId()]);
        $row = $stmt->fetch();
        if ($row) {
            $this->setNom($row['nom']);
            $this->setEmail($row['email']);
            $this->setPasswordHash($row['password_hash']);
            $this->setRoleId($row['role_id']);
            $this->setTel($row['tel']);
        }
    }

    public function update($pdo)
    {
        $stmt = $pdo->prepare("UPDATE utilisateurs SET nom = :nom, email = :email, password_hash = :password_hash, role_id = :role_id, tel = :tel WHERE id = :id");
        $stmt->execute([
            'id' => $this->getId(),
            'nom' => $this->getNom(),
            'email' => $this->getEmail(),
            'password_hash' => $this->getPasswordHash(),
            'role_id' => $this->getRoleId(),
            'tel' => $this->getTel()
        ]);
    }

    public function emailExists($pdo): bool
    {
        $stmt = $pdo->prepare("SELECT COUNT(*) FROM utilisateurs WHERE email = :email");
        $stmt->execute(['email' => $this->getEmail()]);
        return $stmt->fetchColumn() > 0;
    }

    public function isAdmin()
    {
        return $this->role_id === 2; // assuming 2 is admin
    }

    public function verifyUser($pdo) {
        $st = $pdo->prepare("SELECT * FROM utilisateurs WHERE email=? LIMIT 1");
        $st->execute([(string)$this->getEmail()]);
        $row = $st->fetch();

        if ($row && password_verify($this->getPasswordHash(), $row['password_hash'])) {
            $user = new User();
            $user->setId($row['id']);
            $user->setNom($row['nom']);
            $user->setEmail($row['email']);
            $user->setPasswordHash($row['password_hash']);
            $user->setRoleId($row['role_id']);
            $user->setTel($row['tel']);
            return $user;
        }
        return null;
    }

    public static function countAll($pdo)
    {
        $stmt = $pdo->query('SELECT COUNT(*) FROM utilisateurs');
        return $stmt->fetchColumn();
    }

    public function findById($pdo)
    {
        $stmt = $pdo->prepare("SELECT * FROM utilisateurs WHERE id = :id");
        $stmt->execute(['id' => $this->getId()]);
        $row = $stmt->fetch();
        if ($row) {
            $this->setNom($row['nom']);
            $this->setEmail($row['email']);
            $this->setPasswordHash($row['password_hash']);
            $this->setRoleId($row['role_id']);
            $this->setTel($row['tel']);
        }
    }
}
