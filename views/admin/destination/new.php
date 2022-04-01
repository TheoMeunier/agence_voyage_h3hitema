<?php
session_start();

require_once '../../../db.php';

if(isset($_POST['submit'])){

    $titre = $_POST['title'];
    $desc = $_POST['description'];
    $img = $_POST['image'];

    $vtitre = $pdo->query("SELECT name FROM `destination` WHERE name = '$titre'");

    if($vtitre->rowCount() <= 0){
        if(strlen($desc) < 256){
            $insert = $pdo->query("INSERT INTO DESTINATION(name,image,description,created_at) VALUES('$titre', '$img', '$desc', NOW());");
            if($insert){
                header('location:index.php');
            }else{
                $messages[] = 'La destination n\'a pas pu être ajouté';
            }
        }else{
            $messages[] = 'La description est trop longue (255 caractères max)';
        }
    }else{
        $messages[] = 'Cette destination existe déjà';
    }
};

require_once '../../layouts/admin/header.php';
?>

    <div class="d-flex justify-content-between align-items-center w-100 mb-4 underline">
        <h1>Gestion des destinations</h1>
        <a href="index.php" class="btn btn-primary">Liste des destinations</a>
    </div>

        <h1 class="text-center">Ajouter une destination</h1>

        <form action="" method="post" class="mt-3">
            <div class="mb-3">
                <label for="title" class="from-label">Titre</label>
                <input type="text" class="form-control" name="title" required>
            </div>
            <div class="mb-3">
                <label class="form-label" for="">Options</label>
                <select class="form-select" aria-label="Default select example">
                    <option selected>Open this select menu</option>
                    <option value="1">One</option>
                    <option value="2">Two</option>
                    <option value="3">Three</option>
                </select>
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