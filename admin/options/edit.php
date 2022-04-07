<?php

require_once '../../db.php';
require_once '../is_connected.php';

$id = $_GET['id'];
$tag = $pdo->query("SELECT id,name FROM TAG WHERE id = '$id'")->fetch(PDO::FETCH_ASSOC);

if (isset($_POST['submit'])) {
    $name = $_POST['name'];

    if ($name != null){
        $sql = "UPDATE TAG SET name = '$name' WHERE id = '$id'";
        $pdo->query($sql);
        $successes[] = 'Le tag à bien été modifié';
        header('location:index.php');

    } else {
        $errors[] = 'Nous avons rencontré un problème lors de la modification';
    }
}

require_once '../../layouts/admin/header.php';
?>

<div class="d-flex justify-content-between align-items-center w-100 mb-4 underline">
    <h1>Gestion des options</h1>
    <a href="index.php" class="btn btn-primary">Liste des options</a>
</div>

<h2 class="text-center">Modifier un tag</h2>

<form action="" method="post">
    <div class="mb-2">
        <label for="" class="form-label">Nom</label>
        <input class="form-control" name="name" value="<?= $tag['name'] ?>">
    </div>
    <div>
        <button type="submit" name="submit" class="btn btn-primary">Modifier</button>
    </div>
</form>

<?php
require_once '../../layouts/admin/footer.php';
?>
