<?php

include('Connection.php');
function getCateg()
{
    $DBH = connect();
    $result = $DBH->query("Select * from categorie");
    $category = [];
    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        $category[] = $row;
    }
    return $category;
}

function getProduitByCateg($cat)
{
    $DBH = connect();
    $query = "select * from produit where id_categorie=?";
    $stmt = $DBH->prepare($query);
    $stmt->bindParam(1, $cat);
    
    $stmt->execute();

    $category = [];
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $category[] = $row;
    }
    return $category;
}
function getProduitById($id)
{
    $DBH = connect();
    $query = "select * from produit where id_produit=?";
    $stmt = $DBH->prepare($query);
    $stmt->bindParam(1, $id);
    
    $stmt->execute();
    $res= null;
    while( $row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $res=$row;
    }
    return $res;

}
function getProduits()
{
    $DBH = connect();
    $query = "select * from produit";
    $stmt = $DBH->query($query);
    
    $res= [];
    while( $row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $res[]=$row;
    }
    return $res;

}
function upload_produit($nom_produit, $description_produit, $prix_produit, $id_categorie, $image_produit) {
    $DBH = connect();

    $query = "INSERT INTO produit (nom_produit, description_produit, prix_produit, id_categorie, image_produit) VALUES (?, ?, ?, ?, ?)";
    $stmt = $DBH->prepare($query);

    $ok = $stmt->execute([$nom_produit, $description_produit, $prix_produit, $id_categorie, $image_produit]);
    if ($ok) {
        return $DBH->lastInsertId();
    }
    return false;
}

function insert_image($id_produit, $image_produit)  {
    $DBH = connect();

    $query = "INSERT INTO images (id_produit, url_image) VALUES (?, ?)";
    $stmt = $DBH->prepare($query);
    return $stmt->execute([$id_produit, $image_produit]);
}
function supprimer_produit($id_produit) {
    
    $DBH = connect();

    $query = "DELETE FROM produit WHERE id_produit = ?";
    $stmt = $DBH->prepare($query);
    $stmt->bindParam(1, $id_produit);
    return $stmt->execute();
}

function getCategorieById($id_categorie) {
    $DBH = connect();
    $query = "SELECT * FROM categorie WHERE id_categorie = ?";
    $stmt = $DBH->prepare($query);
    $stmt->bindParam(1, $id_categorie);
    $stmt->execute();
    $res = null;
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $res = $row;
    }
    return $res;
}
function imageById($id_produit){
    $DBH = connect();
    $query = "SELECT * FROM images WHERE id_produit = ?";
    $stmt = $DBH->prepare($query);
    $stmt->bindParam(1, $id_produit);
    $stmt->execute();
    $res = [];
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $res[] = $row;
    }
    return $res;
}
