<?php
use controllers\PageController;
use controllers\InscriptionController;
use controllers\LoginController;

Flight::route('GET /', [PageController::class, 'showLogin']);
Flight::route('GET /signup', [PageController::class, 'showSignup']);
Flight::route('GET /index', [PageController::class, 'showIndex']);
Flight::route('GET /about', [PageController::class, 'showAbout']);
Flight::route('GET /contact', [PageController::class, 'showContact']);
Flight::route('GET /list-produit', [PageController::class, 'showListProduit']);
Flight::route('GET /modifier', [PageController::class, 'showModifier']);
Flight::route('GET /single-product', [PageController::class, 'showSingleProduct']);
Flight::route('GET /upload-product', [PageController::class, 'showUploadProduct']);

Flight::route('GET /inscription', [InscriptionController::class, 'showInscription']);
Flight::route('POST /inscription/validate', [InscriptionController::class, 'validateRegister']);
Flight::route('POST /inscription/register', [InscriptionController::class, 'register']);

Flight::route('GET /login', [LoginController::class, 'goToLogin']);
Flight::route('GET /login-admin', [LoginController::class, 'goToAdminLogin']);
Flight::route('POST /login/verifyUser', [LoginController::class, 'verifyUser']);
Flight::route('GET /logout', [LoginController::class, 'logout']);