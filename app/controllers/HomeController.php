<?php

namespace controllers;

use Flight;
use models\Objet;
use models\Categorie;
use models\User;
use models\Echange;

class HomeController
{
    public function showIndex()
    {
        if (session_status() === PHP_SESSION_NONE) session_start();

        $pdo = Flight::db();
        
        // Get all categories
        $categories = Categorie::getAll($pdo);
        
        // Get recent objects
        $objets = Objet::getAllWithLimits($pdo, 10);

        // Check if user is logged in
        $isLoggedIn = isset($_SESSION['user']);
        $user = $isLoggedIn ? $_SESSION['user'] : null;

        Flight::render('index', [
            'categories' => $categories,
            'objets' => $objets,
            'isLoggedIn' => $isLoggedIn,
            'user' => $user
        ]);
    }
}
