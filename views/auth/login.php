<?php
require_once '../layouts/header.php';
?>

<h1 class="mb-2">Connexion</h1>

<form action="">
    <div class="mb-3">
        <label for="name" class="form-label">Non d'utilisateur</label>
        <input type="text" class="form-control" id="name">
    </div>
    <div class="mb-3">
        <label for="password" class="form-label">Email address</label>
        <input type="password" class="form-control" id="password">
    </div>
    <button type="submit" class="btn btn-primary">Se connecter</button>
</form>

<?php
require_once '../layouts/footer.php';
?>
