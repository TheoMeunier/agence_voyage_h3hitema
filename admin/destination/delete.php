<?php

require_once '../../src/Controller/DestinationsController.php';

if (isset($_GET['id'])){
    delete('DESTINATION', $_GET['id']);
} else{
    header('location:index.php');
}