<?php

if (isset($_SESSION['successes'])){
    $success_messages = $_SESSION['successes'];
    unset($_SESSION['successes']);
}

if (isset($_SESSION['errors'])){
    $error_messages = $_SESSION['errors'];
    unset($_SESSION['errors']);
}