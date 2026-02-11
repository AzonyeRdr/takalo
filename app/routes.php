<?php
use controllers\HomeController;
use controllers\InscriptionController;
use controllers\LoginController;
use controllers\BackofficeController;

// Home
Flight::route('GET /', [HomeController::class, 'showIndex']);
Flight::route('GET /index', [HomeController::class, 'showIndex']);

// Authentication
Flight::route('GET /inscription', [InscriptionController::class, 'showInscription']);
Flight::route('POST /inscription/validate', [InscriptionController::class, 'validateRegister']);
Flight::route('POST /inscription/register', [InscriptionController::class, 'register']);

Flight::route('GET /login', [LoginController::class, 'goToLogin']);
Flight::route('GET /login-admin', [LoginController::class, 'goToAdminLogin']);
Flight::route('POST /login/verifyUser', [LoginController::class, 'verifyUser']);
Flight::route('GET /logout', [LoginController::class, 'logout']);

// Backoffice
Flight::route('GET /backoffice', [BackofficeController::class, 'showDashboard']);