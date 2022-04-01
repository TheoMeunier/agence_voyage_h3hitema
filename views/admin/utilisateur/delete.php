<?php
session_start();

// accès à la base de données
require_once '../../../db.php';

//on recupre l'id
$id = $_GET['id'];

//si l'id est alors on crée la resquet
if (isset($id)){
    $query = $pdo->prepare("DELETE FROM user WHERE id = :id_utilisateur");
    $query->execute(['id_utilisateur'=>$id]);

    $successes = "L'utilisateur a bien éte supprimer";
    header('location: index.php');
}