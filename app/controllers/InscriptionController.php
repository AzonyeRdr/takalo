<?php

use app\models\User;

class InscriptionController
{
    private $db;

    public function __construct()
    {
        $this->db = Flight::db();
    }

    /**
     * Show the inscription/registration form
     */
    public function showInscription()
    {
        Flight::render('login/inscription');
    }

    /**
     * Validate registration data (for AJAX validation)
     */
    public function validateRegister()
    {
        header('Content-Type: application/json; charset=utf-8');

        try {
            $req = Flight::request();

            $input = [
                'email' => $req->data->email ?? '',
                'password' => $req->data->password ?? '',
                'confirm_password' => $req->data->confirm_password ?? '',
                'telephone' => $req->data->telephone ?? '',
            ];

            $res = Validator::validateRegister($input, $this->db);
            
            Flight::json([
                'ok' => $res['ok'],
                'errors' => $res['errors'],
                'values' => $res['values'],
            ]);
            
        } catch (Throwable $e) {
            http_response_code(500);
            Flight::json([
                'ok' => false,
                'errors' => [
                    '_global' => 'Erreur serveur lors de la validation.'
                ]
            ]);
        }
    }

    /**
     * Handle registration
     */
    public function register()
    {
        try {
            $req = Flight::request();

            $input = [
                'email' => $req->data->email ?? '',
                'password' => $req->data->password ?? '',
                'confirm_password' => $req->data->confirm_password ?? '',
                'telephone' => $req->data->telephone ?? '',
            ];

            $res = Validator::validateRegister($input, $this->db);

            if ($res['ok']) {
                $user = new User();
                $user->setNom($res['values']['nom']);
                $user->setEmail($res['values']['email']);
                $user->setPasswordHash(password_hash($input['password'], PASSWORD_DEFAULT));
                $user->setRoleId(1); // default user role
                $user->setTel($res['values']['telephone']);
                $user->create($this->db);
                
                Flight::json([
                    'ok' => true,
                    'success' => true,
                    'message' => 'Compte créé avec succès',
                    'user_id' => (int)$user->getId()
                ], 201);
            } else {
                Flight::json([
                    'ok' => false,
                    'success' => false,
                    'errors' => $res['errors']
                ], 400);
            }
        } catch (Throwable $e) {
            Flight::json([
                'ok' => false,
                'success' => false,
                'errors' => [
                    '_global' => 'Une erreur est survenue: ' . $e->getMessage()
                ]
            ], 500);
        }
    }
}
