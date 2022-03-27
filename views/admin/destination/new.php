<?php

require_once '../is_connected.php';
require_once '../../../db.php';

if(isset($_POST['submit'])){

    $titre = $_POST['titre'];
    $desc = $_POST['desc'];
    $img = $_POST['image'];

    $vtitre = $pdo->query("SELECT name FROM `destination` WHERE name = '$titre'");

    $date = date("Y-m-d h:i:sa");

    if($vtitre->rowCount() <= 0){
        if(strlen($desc) < 256){
            $insert = $pdo->query("INSERT INTO DESTINATION(name,image,description,created_at) VALUES('$titre', '$img', '$desc', '$date');");
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
?>

<?php
require_once '../../layouts/admin-header.php';
?>

<section class="content">
    <div class="heading">
        <h1>Gestion des destinations</h1>
        <a href="index.php" class="btn btn-primary">Liste des destinations</a>
    </div>

    <div class="form">
        <h3 class="titre">Ajouter une destination</h3>

        <form action="" method="post">

            <?php
            if(isset($messages)){
                foreach($messages as $message){
                    echo '<div class="message erreur">'.$message.'</div>';
                };
            };
            ?>

            <input type="text" class="champ" placeholder="Titre" name="titre" required>
            <textarea name="desc" class="champ" style="resize:none;" rows="3" placeholder="Description" required></textarea>
            <input type="file" name="image" class="champ" accept="image/png, image/jpg, image/jpeg, image/svg" required>
            <button type="submit" class="btn btn-primary" name="submit">Ajouter</button>
        </form>
    </div>
</section>

<?php
require_once '../../layouts/admin-footer.php';
?>