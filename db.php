<?php

require_once 'variable.php';

$pdo = new PDO("mysql:dbname=".DB_NAME.";host=".DB_HOST,DB_USERNAME, DB_PASSWORD);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
