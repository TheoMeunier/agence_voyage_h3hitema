<?php

require_once '../is_connected.php';
require_once '../../../db.php';

$sql = "SELECT * FROM user ORDER BY id ASC";
$options = $pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);

if(isset($_GET['delete'])){
    if($_GET['delete'] != $_SESSION['id']){
        $delete_id = $_GET['delete'];
        $delete_query = $pdo->query("DELETE FROM user WHERE id = '$delete_id'");
        if($delete_query){
            header('location:index.php');
        }else{
            $messages[] = 'Le compte n\'a pas pu être supprimé';
        };
    }else{
        $messages[] = 'Vous ne pouvez pas supprimer le compte sur lequel vous êtes actuellement';
    }
};

require_once '../../../views/layouts/admin/header.php'
?>

<section class="content">

    <div class="heading">
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
    <div class="width">
        <table class="table">
            <thead>
                <tr class="table-header">
                    <th>ID</th>
                    <th>IDENTIFIANT</th>
                    <th>CRÉÉ LE</th>
                    <th>ACTION</th>
                </tr>
            </thead>

            <tbody>
            <?php if (count($options) > 0) { ?>
                <!-- on affiche tout les utilisateus-->
                <?php foreach ($options as $option) : ?>
                    <tr class="tr_delete">
                        <td class="td_delete"> <?= $option['id']; ?></td>
                        <td class="td_delete"> <?= $option['name']; ?></td>
                        <td class="td_delete"> <?= $option['created_at']; ?></td>
                        <td class="td_delete">
                            <a href="edit.php?edit=<?= $option['id']; ?>" class="btn btn-warning">Modifier</a>
                            <a href="index.php?delete=<?= $option['id']; ?>" class="btn btn-danger" onclick="return confirm('Voulez vous vraiment supprimer ce compte ?')">Supprimer</a>
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
    </div>
</section>

<?php require_once '../../../views/layouts/admin/footer.php'; ?>