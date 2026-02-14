<?php
namespace controllers;

use Flight;
use models\Categorie;

class CategorieController
{
    private $db;

    public function __construct()
    {
        $this->db = Flight::db();
    }

    private function checkAdmin()
    {
        if (session_status() === PHP_SESSION_NONE) session_start();
        if (!isset($_SESSION['session_type']) || $_SESSION['session_type'] !== 'admin') {
            Flight::json(['success' => false, 'message' => 'Non autorisé'], 403);
            return false;
        }
        return true;
    }

    // Page backoffice: CRUD catégories
    public function showCategories()
    {
        if (session_status() === PHP_SESSION_NONE) session_start();
        if (!isset($_SESSION['session_type']) || $_SESSION['session_type'] !== 'admin') {
            Flight::redirect('/login-admin');
            return;
        }

        $categories = Categorie::getAll($this->db);
        Flight::render('backoffice/categories', [
            'categories' => $categories
        ]);
    }

    // API: liste des catégories (JSON)
    public function getAll()
    {
        $categories = Categorie::getAll($this->db);
        Flight::json($categories);
    }

    // API: créer catégorie
    public function createCategorie()
    {
        if (!$this->checkAdmin()) return;

        $req = Flight::request();
        $libelle = $req->data->libelle ?? '';
        $symbole = $req->data->symbole ?? '';
        $description = $req->data->description ?? '';

        if (empty(trim($libelle))) {
            Flight::json(['success' => false, 'message' => 'Le libellé est requis'], 400);
            return;
        }

        $cat = new Categorie();
        $cat->setLibelle($libelle);
        $cat->setSymbole($symbole);
        $cat->setDescription($description);
        $cat->create($this->db);

        Flight::json(['success' => true, 'message' => 'Catégorie créée', 'id' => $cat->getId()]);
    }

    // API: modifier catégorie
    public function updateCategorie($id)
    {
        if (!$this->checkAdmin()) return;

        $req = Flight::request();
        $cat = new Categorie();
        $cat->setId($id);
        $cat->findById($this->db);

        if (!$cat->getLibelle()) {
            Flight::json(['success' => false, 'message' => 'Catégorie non trouvée'], 404);
            return;
        }

        $cat->setLibelle($req->data->libelle ?? $cat->getLibelle());
        $cat->setSymbole($req->data->symbole ?? $cat->getSymbole());
        $cat->setDescription($req->data->description ?? $cat->getDescription());
        $cat->update($this->db);

        Flight::json(['success' => true, 'message' => 'Catégorie modifiée']);
    }

    // API: supprimer catégorie
    public function deleteCategorie($id)
    {
        if (!$this->checkAdmin()) return;

        $cat = new Categorie();
        $cat->setId($id);
        $cat->delete($this->db);

        Flight::json(['success' => true, 'message' => 'Catégorie supprimée']);
    }
}
