<?php

require_once '../../src/Controller/UserController.php';

if (isset($_GET['id'])){
    delete('USER', $_GET['id']);
} else{
    header('location:index.php');
}