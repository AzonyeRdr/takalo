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
        
        // Render login page
        Flight::render('login');
    }

    public function verifyUser() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $email = Flight::request()->data->email ?? '';
        $password = Flight::request()->data->password ?? '';

        // Simple validation without Validator class
        if (empty(trim($email))) {
            Flight::json([
                'success' => false,
                'message' => 'Email is required'
            ], 400);
            return;
        }
        
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            Flight::json([
                'success' => false,
                'message' => 'Invalid email format'
            ], 400);
            return;
        }
        
        if (empty(trim($password))) {
            Flight::json([
                'success' => false,
                'message' => 'Password is required'
            ], 400);
            return;
        }

        // Verify user credentials
        $user = new User();
        $user->setEmail($email);
        $user->setPasswordHash($password);
        $user = $user->verifyUser($this->db);

        if ($user) {
            // Store only user object in session
            $_SESSION['user'] = $user;
            $_SESSION['user_id'] = $user->getId();

            Flight::json([
                'success' => true,
                'message' => 'Login successful',
                'redirect' => '/index'
            ]);
        } else {
            Flight::json([
                'success' => false,
                'message' => 'Invalid email or password'
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
