<?php

// require_once '../is_connected.php';
require_once '../../../db.php';

if(isset($_POST['submit'])){

    $nom = $_POST['nom'];
    $email = $_POST['email'];
    $mdp = hash('sha256', $_POST['mdp']);
    $cmdp = hash('sha256', $_POST['cmdp']);

    $vnom = $pdo->query("SELECT name FROM `user` WHERE name = '$nom'")->fetchAll(PDO::FETCH_ASSOC);
    $vemail = $pdo->query("SELECT email FROM `user` WHERE email = '$email'")->fetchAll(PDO::FETCH_ASSOC);

    $DateAndTime = time(); 

    if(count($vnom) > 0){
        $messages[] = 'Cet utilisateur existe déjà !';
    }else{
        if(count($vemail) > 0){
            $messages[] = 'Cette addresse mail est déjà utilisée !';
        }else{
            if($mdp != $cmdp){
                $messages[] = 'Les MDP ne correspondent pas !';
            }else{
                $insert = $pdo->query("INSERT INTO user(name,email,password,is_admin,created_at) VALUES('$nom','$email','$mdp','yes','$DateAndTime')")->fetchAll(PDO::FETCH_ASSOC);

                if($insert){
                    $messages[] = 'Création du compte réussie';
                    header('location:index.php');
                }else{
                    $messages[] = "Création du compte aborté";
                };
            };
        };
    };
};
?>

<?php
require_once '../../layouts/header.php';
?>

<h1 class="mb-2">Créer un compte admin</h1>

<form action="" method="post">

    <?php
    if(isset($messages)){
        foreach($messages as $message){
            echo '<div class="mb-3">'.$message.'</div>';
        };
    };
    ?>

    <div class="mb-3">
        <label for="name" class="form-label">Nom d'utilisateur</label>
        <input type="text" class="form-control" id="name" name="nom">
    </div>
    <div class="mb-3">
        <label for="password" class="form-label">Email</label>
        <input type="email" class="form-control" id="password" name="email">
    </div>
    <div class="mb-3">
        <label for="password" class="form-label">Mot de Passe</label>
        <input type="password" class="form-control" id="password" name="mdp">
    </div>
    <div class="mb-3">
        <label for="password" class="form-label">Confirmez MDP</label>
        <input type="password" class="form-control" id="password" name="cmdp">
    </div>
    <button type="submit" class="btn btn-primary" name="submit">Créer</button>
</form>

<?php
require_once '../../layouts/footer.php';
?>