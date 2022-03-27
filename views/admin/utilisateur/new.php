<?php

require_once '../is_connected.php';
require_once '../../../db.php';

if(isset($_POST['submit'])){

    $nom = $_POST['nom'];
    $email = $_POST['email'];
    $mdp = hash('sha256', $_POST['mdp']);
    $cmdp = hash('sha256', $_POST['cmdp']);

    $vnom = $pdo->query("SELECT name FROM `user` WHERE name = '$nom'")->fetchAll(PDO::FETCH_ASSOC);
    $vemail = $pdo->query("SELECT email FROM `user` WHERE email = '$email'")->fetchAll(PDO::FETCH_ASSOC);

    $date = date("Y-m-d h:i:sa");

    if(count($vnom) > 0){
        $messages[] = 'Cet utilisateur existe déjà !';
    }else{
        if(count($vemail) > 0){
            $messages[] = 'Cette addresse mail est déjà utilisée !';
        }else{
            if($mdp != $cmdp){
                $messages[] = 'Les MDP ne correspondent pas !';
            }else{
                $insert = $pdo->query("INSERT INTO user(name,email,password,created_at) VALUES('$nom','$email','$mdp','$date')");

                if($insert){
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
require_once '../../layouts/admin/header.php';
?>
    <div class="heading">
        <h1>Gestion des comptes</h1>
        <a href="index.php" class="btn btn-primary">Liste des comptes</a>
    </div>

    <div class="form">
        <h3 class="titre">Créer un compte</h3>

        <form action="" method="post">

            <?php
            if(isset($messages)){
                foreach($messages as $message){
                    echo '<div class="message erreur">'.$message.'</div>';
                };
            };
            ?>

            <input type="text" class="champ" placeholder="Identifiant" name="nom">
            <input type="email" class="champ" placeholder="Email" name="email">
            <input type="password" class="champ" placeholder="Mot de passe" name="mdp">
            <input type="password" class="champ" placeholder="Répétez MDP" name="cmdp">
            <button type="submit" class="btn btn-primary" name="submit">Créer</button>
        </form>
    </div>

<?php
require_once '../../layouts/admin/footer.php';
?>