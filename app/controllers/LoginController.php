<?php

namespace App\Controllers;

use Flight;
use app\models\User;

class LoginController
{
    public function login()
    {
        header('Content-Type: application/json; charset=utf-8');

        $email = $_POST['email'] ?? null;
        $errors = $this->validateLoginInput($email);

        if (!empty($errors)) {
            Flight::json(['success' => false, 'errors' => $errors], 400);
            return;
        }

        try {
            $user = new User();
            $user->setEmail($email);
            $user->findByMail(Flight::db());

            if ($user->getId()) {
                if (session_status() === PHP_SESSION_NONE) {
                    session_start();
                }
                $_SESSION['user'] = $user;
                Flight::json(['success' => true, 'message' => 'Login successful'], 200);
            } else {
                Flight::json(['success' => false, 'errors' => ['email' => 'User not found']], 404);
            }
        } catch (\Exception $e) {
            error_log("Login error: " . $e->getMessage());
            Flight::json(['success' => false, 'errors' => ['general' => $e->getMessage()]], 500);
        }
    }


    private function validateLoginInput(?string $email): array
    {
        $errors = [];

        if (empty($email)) {
            $errors['email'] = 'Email is required';
            return $errors;
        }

        $email = trim($email);

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = 'Email format is invalid';
        }

        return $errors;
    }
}
