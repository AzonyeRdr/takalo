<?php 
$id=$_GET['id_p'];
include('../inc/func.php');
supprimer_produit($id);
header('Location: ../pages/list-produit.php');
?>