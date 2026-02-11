<?php

namespace controllers;

use Flight;
use models\Objet;
use models\User;
use models\Echange;
use models\Categorie;

class BackofficeController
{
    public function showDashboard()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        // Check if user is logged in and is admin
        if (!isset($_SESSION['session_type']) || $_SESSION['session_type'] !== 'admin') {
            Flight::redirect('/login-admin');
            return;
        }

        $pdo = Flight::db();
        
        // Get dashboard statistics
        $stats = [
            'totalUsers' => User::countAll($pdo),
            'totalObjects' => Objet::countAll($pdo),
            'availableObjects' => Objet::countDisponibles($pdo),
            'totalExchanges' => Echange::countAll($pdo),
            'pendingExchanges' => Echange::countByStatut($pdo, 'EN_ATTENTE'),
            'completedExchanges' => Echange::countByStatut($pdo, 'COMPLETE'),
            'categoriesStats' => Categorie::getStats($pdo)
        ];
        
        // Get recent activity
        $activity = [
            'recentObjects' => Objet::getRecentObjets($pdo, 5),
            'recentExchanges' => Echange::getRecent($pdo, 5)
        ];

        Flight::render('backoffice/home', [
            'stats' => $stats,
            'activity' => $activity
        ]);
    }
}
