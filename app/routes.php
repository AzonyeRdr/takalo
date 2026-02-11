<?php
require_once __DIR__ . '/controllers/PageController.php';
require_once __DIR__ . '/controllers/LoginController.php';

use App\Controllers\LoginController;

Flight::route('GET /', ['PageController', 'showLogin']);
Flight::route('GET /signup', ['PageController', 'showSignup']);
Flight::route('GET /index', ['PageController', 'showIndex']);
Flight::route('GET /about', ['PageController', 'showAbout']);
Flight::route('GET /contact', ['PageController', 'showContact']);
Flight::route('GET /list-produit', ['PageController', 'showListProduit']);
Flight::route('GET /modifier', ['PageController', 'showModifier']);
Flight::route('GET /single-product', ['PageController', 'showSingleProduct']);
Flight::route('GET /upload-product', ['PageController', 'showUploadProduct']);

Flight::route('POST /', [LoginController::class, 'login']);
