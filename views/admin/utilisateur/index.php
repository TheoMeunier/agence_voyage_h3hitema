<?php

require_once '../../../db.php';
require_once '../is_connected.php';
require_once '../is_messages.php';

$sql = "SELECT * FROM user ORDER BY id ASC";
$users = $pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);

require_once '../../../views/layouts/admin/header.php';

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
        <h1>Gestion des comptes</h1>
        <a href="new.php" class="btn btn-primary">Créer un compte</a>
    </div>

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