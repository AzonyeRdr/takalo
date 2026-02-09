<?php
function connect()
{
    $host = "localhost";
    $dbname = "ecommerce";// a modifier en fonction de votre base de données
    $user = "root";
    $pass = '';
    try {
        $DBH = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
        $DBH->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $DBH;
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}
