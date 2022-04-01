<?php

require_once '../is_connected.php';
require_once '../../../db.php';

if (isset($_GET['edit'])) {
    $edit_id = $_GET['edit'];
    $edit_query = $pdo->query("SELECT id,name,image,description FROM DESTINATION WHERE id = '$edit_id'")->fetch(PDO::FETCH_ASSOC);
} else {
    header('location:index.php');
};

if (isset($_POST['submit'])) {

    $old_title = $edit_query['name'];
    $old_description = $edit_query['description'];
    $old_image = $edit_query['image'];
    $new_title = $_POST['title'];
    $new_description = $_POST['description'];
    $new_image = $_POST['image'];

    if ($old_title != $new_title) {
        $vtitle = $pdo->query("SELECT id FROM DESTINATION WHERE name = '$new_title'");

        if ($vtitle->rowCount() > 0) {
            $errors[] = 'Cette destination existe déjà !';
        } else {
            $insert = $pdo->query("UPDATE DESTINATION SET name = '$new_title' WHERE id = '$edit_id'");

            if ($insert) {
                $successes[] = 'Le nom de la destination a bien été modifié !';
            } else {
                $errors[] = 'Le changement de nom de la destination a échoué !';
            }
        }
    }
    if ($old_description != $new_description) {
        if (strlen($new_description) < 500) {
            $insert = $pdo->query("UPDATE DESTINATION SET description = '$new_description' WHERE id = '$edit_id'");

            if ($insert) {
                $successes[] = 'La description a bien été modifié !';
            } else {
                $errors[] = 'La modification de la description a échoué !';
            }
        } else {
            $errors[] = 'La description ne doit pas dépasser les 500 caractères !';
        }
    }
    if (strlen($new_image) > 0) {
        if ($old_image != $new_image) {
            $insert = $pdo->query("UPDATE DESTINATION SET image = '$new_image' WHERE id = '$edit_id'");
    
            if ($insert) {
                $successes[] = 'L\'image a bien été modifié !';
            } else {
                $errors[] = 'La modification de l\'image a échoué !';
            }
        }
    }
}

if (isset($successes) && !isset($errors)) {
    header('location:index.php');
}

require_once '../../../views/layouts/admin/header.php'
?>

    <div class="d-flex justify-content-between align-items-center w-100 mb-4 underline">
        <h1>Gestion des destinations</h1>
        <a href="index.php" class="btn btn-primary">Liste des destinations</a>
    </div>

    <h2 class="text-center">Modifier la destination</h2>

    <!-- on liste tous les utilisateurs -->
        <form action="" method="post" class="mt-3">

            <?php
            if (isset($successes)) {
                foreach ($successes as $success) {
                    echo '<div class="message succes">'.$success.'</div>';
                }
            }
            if (isset($errors)) {
                foreach ($errors as $error) {
                    echo '<div class="message erreur">'.$error.'</div>';
                }
            }
            ?>

            <div class="mb-3">
                <label class="form-label" for="nom">Titre</label>
                <input type="text" class="form-control" name="title" value="<?=$edit_query['name'];?>">
            </div>
            <div class="mb-3">
                <label class="form-label" for="desc">Description</label>
                <textarea name="description" class="form-control" rows="3"><?=$edit_query['description'];?></textarea>
            </div>
            <div class="mb-3">
                <label class="form-label" for="img">Image</label>
                <input type="file" class="form-control" name="image" accept="image/png, image/jpg, image/jpeg, image/svg">
            </div>
            <button type="submit" name="submit" class="btn btn-success">Modifier</button>
        </form>

<?php require_once '../../../views/layouts/admin/footer.php'; ?>