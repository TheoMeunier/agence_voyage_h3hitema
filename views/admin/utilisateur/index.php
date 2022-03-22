<?php

require_once '../is_connected.php';
require_once '../../../db.php';

$sql = "SELECT * FROM user ORDER BY id ASC";
$options = $pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);

if(isset($_GET['delete'])){
    $delete_id = $_GET['delete'];
    $delete_query = $pdo->query("DELETE FROM user WHERE id = '$delete_id'");
    if($delete_query){
        header('location:index.php');
        $messages[] = 'Le produit a bien été supprimé';
    }else{
        $messages[] = 'Le produit n\'a pas pu être supprimé';
    };
};

require_once '../../../views/layouts/header.php'
?>

<?php

    if(isset($messages)){
        foreach($messages as $message){
            echo '<div>'.$message.'</div>';
        }
    }

?>

    <div>
        <div class="d-flex justify-content-between align-items-center">
            <h1>Gestion des comptes</h1>
            <a href="new.php" class="btn btn-primary">Créer un compte</a>
        </div>
        <!-- on liste tous les utilisateurs -->
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
                    <td colspan="6" class="text-center">Il n'y à pas d'option</td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
    </div>

<?php require_once '../../../views/layouts/footer.php'; ?>