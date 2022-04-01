<?php

require_once '../is_connected.php';
require_once '../../../db.php';

$sql = "SELECT * FROM user ORDER BY id ASC";
$users = $pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);

require_once '../../../views/layouts/admin/header.php'
?>

    <div class="d-flex justify-content-between align-items-center w-100 mb-4 underline">
        <h1>Gestion des comptes</h1>
        <a href="new.php" class="btn btn-primary">Créer un compte</a>
    </div>

    <?php
        if(isset($messages)){
            foreach($messages as $message){
                echo '<div class="message erreur width">'.$message.'</div>';
            }
        }
    ?>

    <!-- on liste tous les utilisateurs -->
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
                            <a href="edit.php?edit=<?= $user['id']; ?>" class="btn btn-warning">Modifier</a>
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

<?php require_once '../../../views/layouts/admin/footer.php'; ?>