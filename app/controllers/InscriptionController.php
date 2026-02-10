<?php

class InscriptionController
{
    private $userService;
    private $userRepository;

    public function __construct()
    {
        $db = Flight::db();
        $this->userRepository = new UserRepository($db);
        $this->userService = new UserService($this->userRepository);
    }

    /**
     * Show the inscription/registration form
     */
    public function showInscription()
    {
        require __DIR__ . '/../views/inscription.php';
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
                'nom' => $req->data->nom ?? '',
                'prenom' => $req->data->prenom ?? '',
                'email' => $req->data->email ?? '',
                'password' => $req->data->password ?? '',
                'confirm_password' => $req->data->confirm_password ?? '',
                'telephone' => $req->data->telephone ?? '',
            ];

            $res = Validator::validateRegister($input, $this->userRepository);
            
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
                'nom' => $req->data->nom ?? '',
                'prenom' => $req->data->prenom ?? '',
                'email' => $req->data->email ?? '',
                'password' => $req->data->password ?? '',
                'confirm_password' => $req->data->confirm_password ?? '',
                'telephone' => $req->data->telephone ?? '',
            ];

            $res = Validator::validateRegister($input, $this->userRepository);

            if ($res['ok']) {
                $userId = $this->userService->register($res['values'], (string)$input['password']);
                
                Flight::json([
                    'ok' => true,
                    'success' => true,
                    'message' => 'Compte créé avec succès',
                    'user_id' => (int)$userId
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
