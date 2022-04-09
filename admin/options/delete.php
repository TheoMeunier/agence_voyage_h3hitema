<?php
session_start();

// accès à la base de données
require_once '../../db.php';
require_once '../../src/Controller/OptionsController.php';

//on recupre l'id
$id = $_GET['id'];
remove($id);
