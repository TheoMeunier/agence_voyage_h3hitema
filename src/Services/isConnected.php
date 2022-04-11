<?php

session_start();

include '../../db.php';

$id = $_SESSION['id'];
$is_admin = $pdo->query("SELECT id FROM user WHERE id = '$id' AND is_admin = 1")->fetch(PDO::FETCH_ASSOC);

if (!isset($_SESSION['id']) || !$is_admin) {
    header('location:/login.php');
}