<?php
session_start();

// accès à la base de données
require_once '../../db.php';

//on recupère l'id
$id = $_GET['id'];

//si l'id est alors on crée la request
if (isset($id)){
    $query = $pdo->prepare("DELETE FROM destination WHERE id = :id_utilisateur");
    $query->execute(['id_utilisateur'=>$id]);

    $successes[] = "La destination a bien été supprimée";
    $_SESSION['successes'] = $successes;
    header('location: index.php');
}