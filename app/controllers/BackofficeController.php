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

        Flight::render('backoffice/home');
    }
}
