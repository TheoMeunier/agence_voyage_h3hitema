<?php
session_start();

// accès à la base de données
require_once '../../db.php';

//on recupre l'id
$id = $_GET['id'];

//si l'id est alors on crée la resquet
if (isset($id)){
    $query = $pdo->prepare("DELETE FROM TAG WHERE id = :id_tag");
    $query->execute(['id_tag'=>$id]);

    $success = "L'utilisateur a bien été supprimé";
    header('location: index.php');
}