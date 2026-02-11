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
        
        // Get recent objects
        $recentObjects = Objet::getRecentObjets($pdo, 8);
        
        // Get categories with object count
        $categories = Categorie::getAllWithCount($pdo);
        
        Flight::render('index', [
            'recentObjects' => $recentObjects,
            'categories' => $categories
        ]);
    }
}
