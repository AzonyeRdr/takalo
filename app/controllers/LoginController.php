<?php

namespace app\controllers;

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
            Flight::json(['success' => false, 'errors' => $errors]);
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
                Flight::json(['success' => true, 'message' => 'Login successful']);
            } else {
                Flight::json(['success' => false, 'errors' => ['email' => 'User not found']]);
            }
        } catch (\Exception $e) {
            error_log("Login error: " . $e->getMessage());
            Flight::json(['success' => false, 'errors' => ['general' => $e->getMessage()]]);
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
