<?php

require_once '../../src/Table/Table.php';
require_once '../is_messages.php';

$options = findAll('TAG');

require_once '../../layouts/admin/header.php';

if (isset($success_messages)) {
    foreach ($success_messages as $success){
        echo '<p class="message alert-success"><span style="display: flex; align-items: center;"><i style="color: green; font-size: 1.5rem; padding-right: 1rem;" class="fa-regular fa-circle-check"></i>'.$success.'</span><i class="fas fa-times" onclick="this.parentElement.style.display = `none`;"></i></p>';
    }
    unset($success_messages);
}
if (isset($error_messages)) {
    foreach ($error_messages as $error){
        echo '<p class="message alert-danger"><span style="display: flex; align-items: center;"><i style="color: red; font-size: 1.5rem; padding-right: 1rem;" class="fa-solid fa-xmark"></i>'.$error.'</span><i class="fas fa-times" onclick="this.parentElement.style.display = `none`;"></i></p>';
    }
    unset($error_messages);
}

?>

<div class="d-flex justify-content-between align-items-center w-100 mb-4 underline">
    <h1>Gestion des options</h1>
    <a href="new.php" class="btn btn-primary">Créer une option</a>
</div>
<form action="" class="searchbar" method="post">
    <label for="search"><i class="fa-solid fa-magnifying-glass"></i></label>
    <input type="text" name="search" class="form-control" id="search" placeholder="Rechercher un tag">
    <button name="search-submit" class="btn btn-success">Rechercher</button>
</form>
<!-- on liste tout les utilisateurs -->
<table class="table">
    <thead>
    <tr>
        <th>id</th>
        <th>Nom</th>
        <th>Date</th>
        <th>action</th>
    </tr>
    </thead>

    <tbody>
    <?php if (count($options) > 0) { ?>
        <!-- on affiche tout les utilisateus-->
        <?php foreach ($options as $option) : ?>
            <tr>
                <td> <?= $option['id']; ?></td>
                <td> <?= $option['name']; ?></td>
                <td> <?= $option['created_at']; ?></td>
                <td>
                    <a href="/admin/options/edit.php?id=<?= $option['id'] ?>" class="btn btn-warning">Modifier</a>
                    <form action="/admin/options/delete.php?id=<?= $option['id'] ?>" method="post"
                            onsubmit="return confirm('Voulez vous vraiment effectuer cette action ?')"
                            style="display: inline">
                        <button type="submit" class="btn btn-danger">Supprimer</button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
    <?php } else { ?>
        <tr>
            <td colspan="6" class="text-center">Il n'y a pas d'option</td>
        </tr>
    <?php } ?>
    </tbody>
</table>

<?php require_once '../../layouts/admin/footer.php'; ?>