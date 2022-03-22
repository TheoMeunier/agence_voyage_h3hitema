<?php

require_once '../is_connected.php';
require_once '../../../db.php';

$sql = "SELECT * FROM TAG ORDER BY id ASC";
$options = $pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);

require_once '../../../views/layouts/header.php'
?>

    <div>
        <div class="d-flex justify-content-between align-items-center">
            <h1>Gestion des Options</h1>
            <a href="admin/new.php" class="btn btn-primary">Crée une Options</a>
        </div>
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
                    <tr class="tr_delete">
                        <td class="td_delete"> <?= $option['id']; ?></td>
                        <td class="td_delete"> <?= $option['nom']; ?></td>
                        <td class="td_delete"> <?= $option['Date']; ?></td>
                        <td class="td_delete">
                            <form action="admin/delete.php?id=<?= $option['id'] ?>" method="post"
                                  onsubmit="return confirm('Voulez vous vraiment effectuer cette action ?')"
                                  style="display: inline">
                                <button type="submit" class="btn btn-danger">Supprimer</button>
                            </form>
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