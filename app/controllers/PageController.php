<?php

class PageController {

    public function showIndex() {
        Flight::render('index');
    }

    public function showAbout() {
        Flight::render('about');
    }

    public function showContact() {
        Flight::render('contact');
    }

    public function showListProduit() {
        Flight::render('list-produit');
    }

    public function showModifier() {
        Flight::render('modifier');
    }

    public function showSingleProduct() {
        Flight::render('single-product');
    }

    public function showUploadProduct() {
        Flight::render('upload-product');
    }

}

?>