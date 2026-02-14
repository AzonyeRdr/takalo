<?php
namespace controllers;

use Flight;
use models\Objet;
use models\Categorie;
use models\Etat;
use models\Statut;
use models\PhotoObjet;
use models\User;
use models\HistoriqueProprietaire;

class ObjetController
{
    private $db;

    public function __construct()
    {
        $this->db = Flight::db();
    }

    private function getUser()
    {
        if (session_status() === PHP_SESSION_NONE) session_start();
        return $_SESSION['user'] ?? null;
    }

    // Page: tous les objets (avec recherche)
    public function listObjets()
    {
        $pdo = $this->db;
        $categories = Categorie::getAll($pdo);
        $objets = Objet::getAll($pdo);

        Flight::render('objets/list', [
            'categories' => $categories,
            'objets' => $objets
        ]);
    }

    // API AJAX: recherche objets
    public function searchObjets()
    {
        $pdo = $this->db;
        $keyword = Flight::request()->query->keyword ?? '';
        $categorieId = Flight::request()->query->categorie_id ?? null;

        $objets = Objet::search($pdo, $keyword, $categorieId);
        $result = [];

        foreach ($objets as $objet) {
            $photo = $objet->getPhotoPrincipale();
            $result[] = [
                'id' => $objet->getId(),
                'titre' => $objet->getTitre(),
                'description' => $objet->getDescription(),
                'prix_estime' => $objet->getPrixEstime(),
                'proprietaire' => $objet->getProprietaire()->getNom(),
                'proprietaire_id' => $objet->getProprietaire()->getId(),
                'categorie' => $objet->getCategorie()->getLibelle(),
                'etat' => $objet->getEtat()->getLibelle(),
                'statut' => $objet->getStatut()->getLibelle(),
                'photo' => $photo ? $photo->getChemin() : 'default.jpg'
            ];
        }

        Flight::json($result);
    }

    // Page: détail d'un objet
    public function showObjet($id)
    {
        $pdo = $this->db;
        $objet = new Objet();
        $objet->setId($id);
        $objet->findById($pdo);

        if (!$objet->getTitre()) {
            Flight::redirect('/objets');
            return;
        }

        // Historique propriétaires
        $hist = new HistoriqueProprietaire();
        $hist->setObjetId($id);
        $historique = $hist->findByObjetId($pdo);

        // Objets du user connecté (pour modal échange)
        $user = $this->getUser();
        $mesObjets = [];
        if ($user) {
            $objetUser = new Objet();
            $proprietaire = new User();
            $proprietaire->setId($user->getId());
            $objetUser->setProprietaire($proprietaire);
            $mesObjets = $objetUser->getAllByUserDisponible($pdo);
        }

        Flight::render('objets/detail', [
            'objet' => $objet,
            'historique' => $historique,
            'mesObjets' => $mesObjets
        ]);
    }

    // Page: mes objets
    public function mesObjets()
    {
        $user = $this->getUser();
        if (!$user) { Flight::redirect('/login'); return; }

        $pdo = $this->db;
        $proprietaire = new User();
        $proprietaire->setId($user->getId());

        // Utilise le loader sans photos pour accélérer le rendu de la page
        $objets = Objet::getObjetsOfWithoutPhotos($pdo, $proprietaire);
        $categories = Categorie::getAll($pdo);
        $etats = Etat::getAll($pdo);

        Flight::render('objets/mes-objets', [
            'objets' => $objets,
            'categories' => $categories,
            'etats' => $etats
        ]);
    }

    // Page: formulaire ajout objet
    public function showAjoutObjet()
    {
        $user = $this->getUser();
        if (!$user) { Flight::redirect('/login'); return; }

        $pdo = $this->db;
        $categories = Categorie::getAll($pdo);
        $etats = Etat::getAll($pdo);

        Flight::render('objets/ajout', [
            'categories' => $categories,
            'etats' => $etats
        ]);
    }

    // API: créer un objet (avec photos)
    public function createObjet()
    {
        $user = $this->getUser();
        if (!$user) { Flight::json(['success' => false, 'message' => 'Non connecté'], 401); return; }

        $pdo = $this->db;
        $req = Flight::request();

        $titre = $req->data->titre ?? '';
        $description = $req->data->description ?? '';
        $categorieId = $req->data->categorie_id ?? null;
        $etatId = $req->data->etat_id ?? null;
        $prixEstime = $req->data->prix_estime ?? 0;
        $photoPrincipaleIndex = $req->data->photo_principale ?? 0;

        if (empty(trim($titre)) || !$categorieId || !$etatId) {
            Flight::json(['success' => false, 'message' => 'Champs requis manquants'], 400);
            return;
        }

        $pdo->beginTransaction();
        try {
            $objet = new Objet();
            $objet->setTitre($titre);
            $objet->setDescription($description);
            $objet->setPrixEstime((float)$prixEstime);

            $proprietaire = new User();
            $proprietaire->setId($user->getId());
            $objet->setProprietaire($proprietaire);

            $categorie = new Categorie();
            $categorie->setId((int)$categorieId);
            $objet->setCategorie($categorie);

            $etat = new Etat();
            $etat->setId((int)$etatId);
            $objet->setEtat($etat);

            $statut = new Statut();
            $statut->setId(1); // Disponible
            $objet->setStatut($statut);

            $objet->create($pdo);

            // Handle photo uploads
            $files = $_FILES['photos'] ?? null;
            if ($files && isset($files['name'])) {
                $uploadDir = __DIR__ . '/../../public/assets/images/products/';
                if (!is_dir($uploadDir)) mkdir($uploadDir, 0777, true);

                $count = is_array($files['name']) ? count($files['name']) : 1;

                for ($i = 0; $i < $count; $i++) {
                    $tmpName = is_array($files['tmp_name']) ? $files['tmp_name'][$i] : $files['tmp_name'];
                    $fileName = is_array($files['name']) ? $files['name'][$i] : $files['name'];
                    $error = is_array($files['error']) ? $files['error'][$i] : $files['error'];

                    if ($error !== UPLOAD_ERR_OK || empty($fileName)) continue;

                    $ext = pathinfo($fileName, PATHINFO_EXTENSION);
                    $newName = 'obj_' . $objet->getId() . '_' . ($i + 1) . '_' . time() . '.' . $ext;
                    $dest = $uploadDir . $newName;

                    if (move_uploaded_file($tmpName, $dest)) {
                        $photo = new PhotoObjet();
                        $photo->setObjetId($objet->getId());
                        $photo->setChemin($newName);
                        $photo->setOrdre($i + 1);
                        $photo->setEstPrincipale($i == (int)$photoPrincipaleIndex);
                        $photo->create($pdo);
                    }
                }
            }

            // Historique proprietaire initial
            $hist = new HistoriqueProprietaire();
            $hist->setObjetId($objet->getId());
            $hist->setUtilisateurId($user->getId());
            $hist->setEchangeId(null);
            $hist->create($pdo);

            $pdo->commit();
            Flight::json(['success' => true, 'message' => 'Objet créé avec succès', 'id' => $objet->getId()]);
        } catch (\Exception $e) {
            $pdo->rollBack();
            Flight::json(['success' => false, 'message' => 'Erreur: ' . $e->getMessage()], 500);
        }
    }

    // Page: modifier objet
    public function showEditObjet($id)
    {
        $user = $this->getUser();
        if (!$user) { Flight::redirect('/login'); return; }

        $pdo = $this->db;
        $objet = new Objet();
        $objet->setId($id);
        $objet->findById($pdo);

        if (!$objet->getTitre() || $objet->getProprietaire()->getId() !== $user->getId()) {
            Flight::redirect('/mes-objets');
            return;
        }

        $categories = Categorie::getAll($pdo);
        $etats = Etat::getAll($pdo);

        Flight::render('objets/edit', [
            'objet' => $objet,
            'categories' => $categories,
            'etats' => $etats
        ]);
    }

    // API: update objet
    public function updateObjet($id)
    {
        $user = $this->getUser();
        if (!$user) { Flight::json(['success' => false, 'message' => 'Non connecté'], 401); return; }

        $pdo = $this->db;
        $objet = new Objet();
        $objet->setId($id);
        $objet->findById($pdo);

        if (!$objet->getTitre() || $objet->getProprietaire()->getId() !== $user->getId()) {
            Flight::json(['success' => false, 'message' => 'Non autorisé'], 403);
            return;
        }

        $req = Flight::request();
        $objet->setTitre($req->data->titre ?? $objet->getTitre());
        $objet->setDescription($req->data->description ?? $objet->getDescription());
        $objet->setPrixEstime((float)($req->data->prix_estime ?? $objet->getPrixEstime()));

        $categorie = new Categorie();
        $categorie->setId((int)($req->data->categorie_id ?? $objet->getCategorie()->getId()));
        $objet->setCategorie($categorie);

        $etat = new Etat();
        $etat->setId((int)($req->data->etat_id ?? $objet->getEtat()->getId()));
        $objet->setEtat($etat);

        $objet->update($pdo);

        // Handle new photo uploads if any
        $files = $_FILES['photos'] ?? null;
        if ($files && isset($files['name']) && !empty($files['name'][0])) {
            $photoPrincipaleIndex = $req->data->photo_principale ?? 0;
            $uploadDir = __DIR__ . '/../../public/assets/images/products/';

            // Delete old photos
            PhotoObjet::deleteAllByObjet($pdo, $objet);

            $count = is_array($files['name']) ? count($files['name']) : 1;
            for ($i = 0; $i < $count; $i++) {
                $tmpName = is_array($files['tmp_name']) ? $files['tmp_name'][$i] : $files['tmp_name'];
                $fileName = is_array($files['name']) ? $files['name'][$i] : $files['name'];
                $error = is_array($files['error']) ? $files['error'][$i] : $files['error'];

                if ($error !== UPLOAD_ERR_OK || empty($fileName)) continue;

                $ext = pathinfo($fileName, PATHINFO_EXTENSION);
                $newName = 'obj_' . $objet->getId() . '_' . ($i + 1) . '_' . time() . '.' . $ext;
                $dest = $uploadDir . $newName;

                if (move_uploaded_file($tmpName, $dest)) {
                    $photo = new PhotoObjet();
                    $photo->setObjetId($objet->getId());
                    $photo->setChemin($newName);
                    $photo->setOrdre($i + 1);
                    $photo->setEstPrincipale($i == (int)$photoPrincipaleIndex);
                    $photo->create($pdo);
                }
            }
        }

        Flight::json(['success' => true, 'message' => 'Objet modifié avec succès']);
    }

    // API: supprimer objet
    public function deleteObjet($id)
    {
        $user = $this->getUser();
        if (!$user) { Flight::json(['success' => false, 'message' => 'Non connecté'], 401); return; }

        $pdo = $this->db;
        $objet = new Objet();
        $objet->setId($id);
        $objet->findById($pdo);

        if (!$objet->getTitre() || $objet->getProprietaire()->getId() !== $user->getId()) {
            Flight::json(['success' => false, 'message' => 'Non autorisé'], 403);
            return;
        }

        PhotoObjet::deleteAllByObjet($pdo, $objet);
        $objet->delete($pdo);

        Flight::json(['success' => true, 'message' => 'Objet supprimé avec succès']);
    }
}
