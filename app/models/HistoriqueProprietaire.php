<?php
namespace models;

class HistoriqueProprietaire
{
    private ?int $id = null;
    private ?int $objetId = null;
    private ?int $utilisateurId = null;
    private ?int $echangeId = null;
    private ?string $dateAcquisition = null;

    public function __construct() {}

    public function getId(): ?int { return $this->id; }
    public function setId(?int $id): void { $this->id = $id; }

    public function getObjetId(): ?int { return $this->objetId; }
    public function setObjetId(?int $objetId): void { $this->objetId = $objetId; }

    public function getUtilisateurId(): ?int { return $this->utilisateurId; }
    public function setUtilisateurId(?int $utilisateurId): void { $this->utilisateurId = $utilisateurId; }

    public function getEchangeId(): ?int { return $this->echangeId; }
    public function setEchangeId(?int $echangeId): void { $this->echangeId = $echangeId; }

    public function getDateAcquisition(): ?string { return $this->dateAcquisition; }
    public function setDateAcquisition(?string $dateAcquisition): void { $this->dateAcquisition = $dateAcquisition; }

    public function create($pdo)
    {
        $stmt = $pdo->prepare('INSERT INTO historique_proprietaire_objet (objet_id, utilisateur_id, echange_id) VALUES (:objet_id, :utilisateur_id, :echange_id)');
        $stmt->execute([
            'objet_id' => $this->getObjetId(),
            'utilisateur_id' => $this->getUtilisateurId(),
            'echange_id' => $this->getEchangeId()
        ]);
        $this->setId($pdo->lastInsertId());
    }

    public function findByObjetId($pdo)
    {
        $stmt = $pdo->prepare('SELECT * FROM v_historique_objet WHERE objet_id = :objet_id ORDER BY date_acquisition ASC');
        $stmt->execute(['objet_id' => $this->getObjetId()]);
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }
}
