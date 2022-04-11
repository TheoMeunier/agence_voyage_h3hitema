<?php

require_once '../../src/Controller/OptionsController.php';

if (isset($_GET['id'])){
    delete('TAG', $_GET['id']);
} else{
    header('location:index.php');
}
