<?php

require_once '../is_connected.php';
require_once '../../../db.php';

$sql = "SELECT * FROM DESTINATION ORDER BY id ASC";
$destinations = $pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);

require_once '../../../views/layouts/admin/header.php'
?>

    <div class="d-flex justify-content-between align-items-center w-100 mb-4">
        <h1>Gestion des destinations</h1>
        <a href="new.php" class="btn btn-primary">Ajouter une destination</a>
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
                <th>ID</th>
                <th>TITRE</th>
                <th>CRÉÉ LE</th>
                <th>ACTION</th>
            </tr>
        </thead>

        <tbody>
        <?php if (count($destinations) > 0) { ?>
            <!-- on affiche tout les utilisateus-->
            <?php foreach ($destinations as $destination) : ?>
                <tr>
                    <td> <?= $destinations['id']; ?></td>
                    <td> <?= $destinations['name']; ?></td>
                    <td> <?= $destinations['created_at']; ?></td>
                    <td>
                        <a href="edit.php?edit=<?= $destinations['id']; ?>" class="btn btn-warning">Modifier</a>
                        <a href="index.php?delete=<?= $destinations['id']; ?>" class="btn btn-danger" onclick="return confirm('Voulez vous vraiment supprimer ce compte ?')">Supprimer</a>
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

<?php require_once '../../../views/layouts/admin/footer.php'; ?>