<?php
// require_once '../is_connected.php';
require_once '../../../db.php';

$sql = "SELECT * FROM DESTINATION ORDER BY id ASC";
$options = $pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);

include 'views/layouts/header.php'
?>

    <div>
        <h1>Gestion des destination</h1>

        <div>
            <a href="admin/new.php" class="btn btn-primary">Crée une destination</a>
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
                    <tr>
                        <td><?= $option['id']; ?></td>
                        <td><?= $options['nom']; ?></td>
                        <td><?= $options['Date']; ?></td>
                        <td>
                            <a href="" class="btn btn-primary"></a>
                            <form action="#" method="post"
                                  onsubmit="return confirm('Voulez vous vraiment effectuer cette action ?')"
                                  style="display: inline">
                                <button type="submit" class="btn btn-danger">Supprimer</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php } else { ?>
                <p>Il n'y à pas d'option</p>
            <?php } ?>
            </tbody>
        </table>
    </div>

<?php include 'views/layouts/footer.php'; ?>