<?php

require_once '../is_connected.php';
require_once '../../../db.php';

if(isset($_POST['submit'])){

    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = hash('sha256', $_POST['password']);
    $cpassword = hash('sha256', $_POST['cpassword']);

    $vname = $pdo->query("SELECT name FROM `user` WHERE name = '$name'")->fetchAll(PDO::FETCH_ASSOC);
    $vemail = $pdo->query("SELECT email FROM `user` WHERE email = '$email'")->fetchAll(PDO::FETCH_ASSOC);

    if(count($vname) > 0){
        $errors[] = 'Cet utilisateur existe déjà !';
    }else{
        if(count($vemail) > 0){
            $errors[] = 'Cette addresse mail est déjà utilisée !';
        }else{
            if($password != $cpassword){
                $errors[] = 'Les MDP ne correspondent pas !';
            }else{
                $insert = $pdo->query("INSERT INTO user(name,email,password,created_at) VALUES('$name','$email','$password', NOW())");

                if($insert){
                    header('location:index.php');
                }else{
                    $errors[] = "Création du compte aborté";
                };
            };
        };
    };
};
?>

<?php
require_once '../../layouts/admin/header.php';
?>
    <div class="d-flex justify-content-between align-items-center w-100 mb-4 underline">
        <h1>Gestion des comptes</h1>
        <a href="index.php" class="btn btn-primary">Liste des comptes</a>
    </div>

    <h2 class="text-center">Créer un compte</h2>

    <form action="" method="post" class="mt-3">

        <?php
        if(isset($errors)){
            foreach($errors as $error){
                echo '<div class="message erreur">'.$error.'</div>';
            };
        };
        ?>
        <div class="mb-3">
            <label for="name">Identifiant :</label>
            <input type="text" class="form-control" id="name" name="name">
        </div>
        <div class="mb-3">
            <label for="email">Email :</label>
            <input type="email" class="form-control" id="email" name="email">
        </div>
        <div class="mb-3">
            <label for="password">Mot de passe :</label>
            <input type="password" class="form-control" id="password" name="password">
        </div>
        <div class="mb-3">
            <label for="cpassword">Confirmez votre mot de passe :</label>
            <input type="password" class="form-control" id="cpassword" name="cpassword">
        </div>
        <button type="submit" class="btn btn-primary" name="submit">Créer</button>
    </form>

<?php
require_once '../../layouts/admin/footer.php';
?>