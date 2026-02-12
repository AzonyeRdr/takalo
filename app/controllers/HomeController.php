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
        $pdo = Flight::db();
        
        // Get all categories
        $categories = Categorie::getAll($pdo);
        
        // Get recent objects
        $objets = Objet::getAllWithLimits($pdo, 10);
        
        Flight::render('index', [
            'categories' => $categories,
            'objets' => $objets
        ]);
    }
}
