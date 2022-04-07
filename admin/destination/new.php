<?php

require_once '../../db.php';
require_once '../is_connected.php';
require_once '../is_messages.php';

$sql="SELECT id,name FROM TAG ORDER BY name ASC";
$tags_list = $pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);

if(isset($_POST['submit'])){

    $title = $_POST['title'];
    $tags = $_POST['tags'];
    $description = $_POST['description'];
    $image = $_FILES['image']['name'];
    $image_tmp_name = $_FILES['image']['tmp_name'];
    $image_folder = '../../assets/uploaded_img/'.$image;

    $vtitle = $pdo->query("SELECT name FROM `destination` WHERE name = '$title'");

    if($vtitle->rowCount() <= 0){
        if(strlen($description) < 256){
            if (isset($tags) && count($tags) > 0){

                $tags_id = " ";
                foreach ($tags as $tag_id){
                    $tags_id = $tags_id . $tag_id . ' ';
                }
                $insert = $pdo->query("INSERT INTO DESTINATION(name,image,description,created_at,tags) VALUES('$title', '$image', '$description', NOW(), '$tags_id');");
                if($insert){
                    move_uploaded_file($image_tmp_name, $image_folder);
                    $successes[] = 'La destination a bien été ajoutée';
                }else{
                    $errors[] = 'La destination n\'a pas pu être ajouté';
                }
            } else{
                $errors[] = 'Veuillez attribuer au moins un tag à la destination';
            }
        }else{
            $errors[] = 'La description est trop longue (255 caractères max)';
        }
    }else{
        $errors[] = 'Cette destination existe déjà';
    }
};

if (isset($successes) && !isset($errors)){
    $_SESSION['successes'] = $successes;
    header('location:index.php');
} else if (isset($successes) && isset($errors)){
    $_SESSION['errors'] = $errors;
    $_SESSION['successes'] = $successes;
    header('location:new.php');
} else if (!isset($successes) && isset($errors)){
    $_SESSION['errors'] = $errors;
    header('location:new.php');
}

require_once '../../layouts/admin/header.php';

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
        <h1>Gestion des destinations</h1>
        <a href="index.php" class="btn btn-primary">Liste des destinations</a>
    </div>

        <h2 class="text-center">Ajouter une destination</h2>

        <form action="" method="post" enctype="multipart/form-data" class="mt-3">

            <div class="mb-3">
                <label for="title" class="from-label">Titre</label>
                <input type="text" class="form-control" name="title" required>
            </div>
            <div class="mb-3">
                <label class="form-label" for="">Options</label>
                <div class="checkbox">
                    <?php foreach ($tags_list as $tag_list):  ?>
                        <div class="input-group-text" style="margin-bottom: .3rem;">
                            <label><input type="checkbox" value="<?= $tag_list['id']; ?>" name="tags[]"> <?= $tag_list['name']; ?> </label>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
            <div class="mb-3">
                <label class="form-label" for="image">Image</label>
                <input type="file" name="image" class="form-control" accept="image/png, image/jpg, image/jpeg, image/svg" required>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control" id="description" name="description" rows="3"></textarea>
            </div>
            <div>
                <button type="submit" class="btn btn-primary" name="submit">Créer</button>
            </div>
        </form>

<?php
require_once '../../layouts/admin/footer.php';
?>