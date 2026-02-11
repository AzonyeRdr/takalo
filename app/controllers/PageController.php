<?php

namespace app\controllers;

use Flight;

class PageController
{
    public static function showLogin()
    {
        Flight::render('login');
    }
    public static function showSignup()
    {
        Flight::render('signup');
    }
    public static function showIndex()
    {
        Flight::render('index');
    }
    public static function showAbout()
    {
        Flight::render('about');
    }

    public static function showContact()
    {
        Flight::render('contact');
    }

    public static function showListProduit()
    {
        Flight::render('list-produit');
    }

    public static function showModifier()
    {
        Flight::render('modifier');
    }

    public static function showSingleProduct()
    {
        Flight::render('single-product');
    }

    public static function showUploadProduct()
    {
        Flight::render('upload-product');
    }
}
