<?php
namespace controllers;

use Flight;
use Throwable;
use models\User;

class LoginController {
    private $db;

    public function __construct()
    {
        $this->db = Flight::db();
    }


    public function goToLogin() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        session_unset();
        session_destroy();
        
        // Render user login page
        Flight::render('login/login-user');
    }

    public function goToAdminLogin() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        session_unset();
        session_destroy();
        
        // Render admin login page
        Flight::render('login/login-admin');
    }

    public function verifyUser() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $email = Flight::request()->data->email ?? '';
        $password = Flight::request()->data->password ?? '';
        $loginType = Flight::request()->data->loginType ?? 'user'; 

        // Simple validation
        if (empty(trim($email))) {
            Flight::json([
                'success' => false,
                'message' => 'L\'email est requis'
            ], 400);
            return;
        }
        
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            Flight::json([
                'success' => false,
                'message' => 'Format d\'email invalide'
            ], 400);
            return;
        }
        
        if (empty(trim($password))) {
            Flight::json([
                'success' => false,
                'message' => 'Le mot de passe est requis'
            ], 400);
            return;
        }

        // Verify user credentials
        $user = new User();
        $user->setEmail($email);
        $user->setPasswordHash($password);
        $user = $user->verifyUser($this->db);

        if ($user) {
            // Check if login type matches user role
            if ($loginType === 'admin' && !$user->isAdmin()) {
                Flight::json([
                    'success' => false,
                    'message' => 'Accès refusé. Identifiants administrateur requis.'
                ], 403);
                return;
            }

            // Store user in session
            $_SESSION['user'] = $user;
            $_SESSION['user_id'] = $user->getId();
            $_SESSION['user_role'] = $user->getRoleId();
            
            // Set session type
            if ($user->isAdmin()) {
                $_SESSION['session_type'] = 'admin';
            } else {
                $_SESSION['session_type'] = 'user';
            }

            Flight::json([
                'success' => true,
                'message' => 'Connexion réussie',
                'redirect' => '/index',
                'sessionType' => $_SESSION['session_type']
            ]);
        } else {
            Flight::json([
                'success' => false,
                'message' => 'Email ou mot de passe invalide'
            ], 401);
        }
    }

    public function logout() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        // Destroy session
        session_unset();
        session_destroy();

        Flight::redirect('/');
    }
}
