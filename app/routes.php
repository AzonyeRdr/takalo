<?php
require_once __DIR__ . '/controllers/PageController.php';
require_once __DIR__ . '/controllers/LoginController.php';

use app\controllers\LoginController;
use app\controllers\PageController;

Flight::route('GET /', [PageController::class, 'showLogin']);
Flight::route('GET /signup', [PageController::class, 'showSignup']);
Flight::route('GET /index', [PageController::class, 'showIndex']);
Flight::route('GET /about', [PageController::class, 'showAbout']);
Flight::route('GET /contact', [PageController::class, 'showContact']);
Flight::route('GET /list-produit', [PageController::class, 'showListProduit']);
Flight::route('GET /modifier', [PageController::class, 'showModifier']);
Flight::route('GET /single-product', [PageController::class, 'showSingleProduct']);
Flight::route('GET /upload-product', [PageController::class, 'showUploadProduct']);

Flight::route('POST /', [LoginController::class, 'login']);
