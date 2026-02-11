<?php
namespace models;

class Etat
{
    private ?int $id;
    private ?string $code;
    private ?string $libelle;

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

    public function getCode(): ?string
    {
        return $this->code;
    }

    public function setCode(?string $code): void
    {
        $this->code = $code;
    }

    public function getLibelle(): ?string
    {
        return $this->libelle;
    }

    public function setLibelle(?string $libelle): void
    {
        $this->libelle = $libelle;
    }

    public function findById($pdo)
    {
        $stmt = $pdo->prepare('SELECT * FROM etats_objet WHERE id = :id');
        $stmt->execute(['id' => $this->getId()]);
        $etat = $stmt->fetch();
        if ($etat) {
            $this->setCode($etat['code']);
            $this->setLibelle($etat['libelle']);
        }
    }

    public static function getAll($pdo)
    {
        $stmt = $pdo->query('SELECT * FROM etats_objet ORDER BY libelle ASC');
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }
}
