<?php

require_once '../../src/Controller/OptionsController.php';

if (isSubmit()) {
    $name = $_POST['name'];

    $vname = findWhere('TAG', 'name', $name);
    if (isNotBlank($name)){
        if ($vname->rowCount() <= 0) {
            $data = [
                'name' => $name,
                'created_at' => date('y-m-d h:i:s')
            ];
    
            create('TAG', $data);
            setMessages(); exit;
        } else{
            alert('error', "Ce tag existe déjà");
        }
    } else{
        alert('error', 'Veuillez indiquer un nom valide');
    }
}

require_once '../../layouts/admin/header.php';

displayMessages();
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
        <button type="submit" name="submit" class="btn btn-primary">Créer</button>
    </div>
</form>

<?php
require_once '../../layouts/admin/header.php'
?>
