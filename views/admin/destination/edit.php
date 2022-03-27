<?php

require_once '../is_connected.php';
require_once '../../../db.php';

if(isset($_GET['edit'])){
    $edit_id = $_GET['edit'];
    $edit_query = $pdo->query("SELECT id,name,image,description FROM DESTINATION WHERE id = '$edit_id'")->fetch(PDO::FETCH_ASSOC);
}else{
    header('location:index.php');
};

if(isset($_POST['submit'])){
    $old_title = $edit_query['name'];
    $old_desc = $edit_query['description'];
    $new_title = $_POST['titre'];
    $new_desc = $_POST['desc'];
    $new_img = $_POST['image'];

    if($old_title != $new_title){
        $vnew_title = $pdo->query("SELECT id FROM DESTINATION WHERE name = '$new_title'");
        if($vnew_title->rowCount() <= 0){
            $insert = $pdo->query("UPDATE DESTINATION SET name = '$new_title' WHERE id = '$edit_id'");
            if($insert){
                $succes[] = 'Le titre a bien été modifié';
            }else{
                $erreurs[] = 'Le titre n\'a pas été changé';
            }
        }else{
            $erreurs[] = 'Cette destination existe déjà';
        }
    }
    if($old_desc != $new_desc){
        if(strlen($new_desc) < 256){
            $insert = $pdo->query("UPDATE DESTINATION SET description = '$new_desc' WHERE id = '$edit_id'");
            if($insert){
                $succes[] = 'La description a bien été modifiée';
            }else{
                $erreurs[] = 'La description n\'a pas été changée';
            }
        }else{
            $erreurs[] = 'La description est trop longue (255 caractères max)';
        }
    }
    if(strlen($new_img) > 0){
        $insert = $pdo->query("UPDATE DESTINATION SET image = '$new_img' WHERE id = '$edit_id'");
        if($insert){
            $succes[] = 'L\'image a bien été modifiée';
        }else{
            $erreurs[] = 'L\'image n\'a pas été changée';
        }
    }
    
    
}

require_once '../../../views/layouts/admin-header.php'
?>

<section class="content">

    <div class="heading">
        <h1>Gestion des destinations</h1>
        <a href="index.php" class="btn btn-primary">Liste des destinations</a>
    </div>
    <!-- on liste tous les utilisateurs -->
    <div class="form">
        <form action="" method="post">
            <?php
                if(isset($succes)){
                    foreach($succes as $succes){
                        echo '<div class="message succes">'.$succes.'</div>';
                    }
                }
                if(isset($erreurs)){
                    foreach($erreurs as $erreur){
                        echo '<div class="message erreur">'.$erreur.'</div>';
                    }
                }
            ?>
            <div>
                <label for="nom">Titre:</label>
                <input type="text" class="champ" name="titre" value="<?=$edit_query['name'];?>">
            </div>
            <div>
                <label for="desc">Description:</label>
                <textarea name="desc" style="resize:none;" class="champ" rows="3"><?=$edit_query['description'];?></textarea>
            </div>
            <div>
                <label for="img">Nouvelle image:</label>
                <input type="file" class="champ" name="image" accept="image/png, image/jpg, image/jpeg, image/svg">
            </div>
            <input type="submit" name="submit" value="Modifier" class="btn btn-success"></a>
        </form>
    </div>
</section>

<?php require_once '../../../views/layouts/admin-footer.php'; ?>