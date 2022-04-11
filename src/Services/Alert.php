<?php

function alert(string $type, string $message)
{
    if ($type == 'success'){
        if (!isset($_SESSION['successes'])){
            $_SESSION['successes'] = [];
        }
        array_push($_SESSION['successes'], $message);
    } else if ($type == 'error'){
        if (!isset($_SESSION['errors'])){
            $_SESSION['errors'] = [];
        }
        array_push($_SESSION['errors'], $message);
    }
}

function Redirect()
{
    if (isset($_GET['id'])){
        if (isset($_SESSION['successes']) && !isset($_SESSION['errors'])){
            header('location:index.php');
        } else{
            header('location:edit.php?id=' . $_GET['id']);
        }
    } else{
        if (isset($_SESSION['successes']) && !isset($_SESSION['errors'])){
            header('location:index.php');
        } else{
            header('location:new.php');
        }
    }
}

function displayMessages(){
    if (isset($_SESSION['successes'])) {
        foreach ($_SESSION['successes'] as $success){
            echo '<p class="message alert-success"><span style="display: flex; align-items: center;"><i style="color: green; font-size: 1.5rem; padding-right: 1rem;" class="fa-regular fa-circle-check"></i>'.$success.'</span><i class="fas fa-times" onclick="this.parentElement.style.display = `none`;"></i></p>';
        }
        unset($_SESSION['successes']);
    }
    if (isset($_SESSION['errors'])) {
        foreach ($_SESSION['errors'] as $error){
            echo '<p class="message alert-danger"><span style="display: flex; align-items: center;"><i style="color: red; font-size: 1.5rem; padding-right: 1rem;" class="fa-solid fa-xmark"></i>'.$error.'</span><i class="fas fa-times" onclick="this.parentElement.style.display = `none`;"></i></p>';
        }
        unset($_SESSION['errors']);
    }
}