<?php

require_once '../../src/Services/isConnected.php';
require_once '../../src/Table/Table.php';
require_once '../is_messages.php';

$destinations = findAll('DESTINATION');

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
        <h1>Gestion des destinations</h1>
        <a href="new.php" class="btn btn-primary">Ajouter une destination</a>
    </div>
    <form action="" class="searchbar" method="post">
        <label for="search"><i class="fa-solid fa-magnifying-glass"></i></label>
        <input type="text" name="search" class="form-control" id="search" placeholder="Rechercher une destination">
        <button name="search-submit" class="btn btn-success">Rechercher</button>
    </form>

    <!-- on liste toutes les destinations -->
    <table class="table">
        <thead>
            <tr class="table-header">
                <th>ID</th>
                <th>TITRE</th>
                <th>TAGS</th>
                <th>CRÉÉ LE</th>
                <th>ACTION</th>
            </tr>
        </thead>

        <tbody>
        <?php if (count($destinations) > 0) { ?>
            <!-- on affiche toutes les destinations-->
            <?php foreach ($destinations as $destination) : ?>
                <tr>
                    <td> <?= $destination['id']; ?></td>
                    <td> <?= $destination['name']; ?></td>
                    <td>
                        <?php
                            $tags_list = explode(" ", $destination['tags']);
                            array_shift($tags_list);
                            array_pop($tags_list);
                            $tags_name = [];
                            foreach ($tags_list as $tag_id){
                                $tag_name = find('TAG', $tag_id);
                                array_push($tags_name, $tag_name['name']);
                            }
                            echo implode(' | ', $tags_name);
                        ?>
                    </td>
                    <td> <?= $destination['created_at']; ?></td>
                    <td>
                        <a href="edit.php?id=<?= $destination['id']; ?>" class="btn btn-warning">Modifier</a>
                        <form action= "delete.php?id=<?= $destination['id'] ?>" method="post" onsubmit="return confirm('Voulez-vous vraiment supprimer cette destination ?')" style="display: inline">
                            <button type="submit" class="btn btn-danger">Supprimer</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php } else { ?>
            <tr>
                <td colspan="6" class="text-center">Il n'y a pas de destination</td>
            </tr>
        <?php } ?>
        </tbody>
    </table>

<?php require_once '../../layouts/admin/footer.php'; ?>