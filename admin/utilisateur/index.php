<?php

require_once '../../src/Controller/UserController.php';

$users = findAll('USER');

require_once '../../layouts/admin/header.php';

displayMessages()
?>

    <div class="d-flex justify-content-between align-items-center w-100 mb-4 underline">
        <h1>Gestion des comptes</h1>
        <a href="new.php" class="btn btn-primary">Créer un compte</a>
    </div>
    <form action="" class="searchbar" method="post">
        <label for="search"><i class="fa-solid fa-magnifying-glass"></i></label>
        <input type="text" name="search" class="form-control" id="search" placeholder="Rechercher un utilisateur">
        <button name="search-submit" class="btn btn-success">Rechercher</button>
    </form>

        <table class="table">
            <thead>
                <tr class="table-header">
                    <th>Id</th>
                    <th>Nom</th>
                    <th>Email</th>
                    <th>Rôles</th>
                    <th>Crée le</th>
                    <th></th>
                </tr>
            </thead>

            <tbody>
            <?php if (count($users) > 0) { ?>
                <!-- on affiche tout les utilisateus-->
                <?php foreach ($users as $user) : ?>
                    <tr class="tr_delete">
                        <td> <?= $user['id']; ?></td>
                        <td> <?= $user['name']; ?></td>
                        <td> <?= $user['email']; ?></td>
                        <td> <?= $user['is_admin'] === 1 ? 'admin' : ''; ?></td>
                        <td> <?= $user['created_at']; ?></td>
                        <td>
                            <a href="edit.php?id=<?= $user['id']; ?>" class="btn btn-warning">Modifier</a>
                            <form action= "delete.php?id=<?=$user['id'] ?>" method="post"
                                  onsubmit="return confirm('Voulez-vous vraiment supprimer cette destination ?')" style="display: inline">
                                <button type="submit" class="btn btn-danger">Supprimer</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php } else { ?>
                <tr>
                    <td colspan="6" class="text-center">Il n'y a pas d'utilisateur créer</td>
                </tr>
            <?php } ?>
            </tbody>
        </table>

<?php require_once '../../layouts/admin/footer.php'; ?>