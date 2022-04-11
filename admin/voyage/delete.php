<?php

require_once '../../src/Controller/VoyagesController.php';

if (isset($_GET['id'])){
    delete('TRAVEL', $_GET['id']);
} else{
    header('location:index.php');
}