<?php

require_once '../../db.php';
require_once '../is_connected.php';

require_once '../../layouts/admin/header.php'
?>

<div class="d-flex justify-content-between align-items-center w-100 mb-4 underline">
    <h1>Gestion des options</h1>
    <a href="index.php" class="btn btn-primary">Liste des options</a>
</div>

<h2 class="text-center">Créer un tag</h2>

<form action="" method="post">
    <div class="mb-2">
        <label for="" class="form-label">Nom</label>
        <input class="form-control" name="name">
    </div>
    <div>
        <button type="submit" class="btn btn-primary">Créer</button>
    </div>
</form>

<?php
require_once '../../layouts/admin/header.php'
?>
