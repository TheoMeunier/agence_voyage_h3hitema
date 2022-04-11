<?php

require_once '../../src/Controller/OptionsController.php';

if (isset($_GET['id'])) {
    $edit_id = $_GET['id'];
    $tag = find('TAG', $edit_id);
} else {
    header('location:index.php');
};

if (isSubmit()) {
    $name = $_POST['name'];

    if (isNotBlank($name)){
        if (Exist('TAG', 'name', $name)) {
            $data = [
                'name' => $name,
                'id' => $id
            ];
            update('TAG', $data, $edit_id);
        } else {
            alert('error', 'Ce tag existe déjà');
        }

    } else {
        alert('error', 'Veuillez donner un nom valide au tag');
    }

    Redirect(); exit;
}

require_once '../../layouts/admin/header.php';

displayMessages()
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
