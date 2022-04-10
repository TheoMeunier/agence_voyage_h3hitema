<?php
session_start();

// accès à la base de données
require_once '../../db.php';

//on recupère l'id
$id = $_GET['id'];

//si l'id est alors on crée la request
if (isset($id)){
    $query = $pdo->prepare("DELETE FROM TRAVEL WHERE id = :id_voyage");
    $query->execute(['id_voyage'=>$id]);

    $successes[] = "Le voyage a bien été supprimé";
    $_SESSION['successes'] = $successes;
    header('location: index.php');
}