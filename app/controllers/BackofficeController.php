<?php

namespace controllers;

use Flight;
use models\Objet;
use models\User;
use models\Echange;
use models\Categorie;

class BackofficeController
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
            Flight::redirect('/login-admin');
            return false;
        }
        return true;
    }

    public function showDashboard()
    {
        if (!$this->checkAdmin()) return;

        $pdo = $this->db;
        $nbUsers = User::countAll($pdo);
        $nbObjets = Objet::countAll($pdo);
        $nbEchanges = Echange::countAll($pdo);
        $nbCategories = Categorie::countAll($pdo);

        Flight::render('backoffice/home', [
            'nbUsers' => $nbUsers,
            'nbObjets' => $nbObjets,
            'nbEchanges' => $nbEchanges,
            'nbCategories' => $nbCategories
        ]);
    }

    public function showStats()
    {
        if (!$this->checkAdmin()) return;

        $pdo = $this->db;
        $nbUsers = User::countAll($pdo);
        $nbEchanges = Echange::countAll($pdo);
        $nbObjets = Objet::countAll($pdo);
        $nbCategories = Categorie::countAll($pdo);
        $recentEchanges = Echange::getRecent($pdo, 10);

        Flight::render('backoffice/stats', [
            'nbUsers' => $nbUsers,
            'nbEchanges' => $nbEchanges,
            'nbObjets' => $nbObjets,
            'nbCategories' => $nbCategories,
            'recentEchanges' => $recentEchanges
        ]);
    }

    public function showUsers()
    {
        if (!$this->checkAdmin()) return;

        $pdo = $this->db;
        $users = User::getAll($pdo);

        Flight::render('backoffice/users', [
            'users' => $users
        ]);
    }

    public function showObjets()
    {
        if (!$this->checkAdmin()) return;

        $pdo = $this->db;
        $objets = Objet::getAll($pdo);

        Flight::render('backoffice/objets', [
            'objets' => $objets
        ]);
    }
}
