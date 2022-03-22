<?php

session_start();

require_once '../../db.php';

if(isset($_POST['submit'])){

    $nom = $_POST['nom'];
    $mdp = hash('sha256', $_POST['mdp']);

    $data = $pdo->query("SELECT id FROM `user` WHERE name = '$nom' AND password = '$mdp'")->fetchAll(PDO::FETCH_ASSOC);

    if(count($data) > 0){
        // $_SESSION['id'] = $query['id'];
        echo $data['id'];
        // header('location:../admin/options/index.php');
    }else{
        $messages[] = "L'identifiant ou le mot de passe est incorrecte";
    }
}

?>


<?php
require_once '../layouts/header.php';
?>

<h1 class="mb-2">Connexion</h1>

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
        <input name="nom" type="text" class="form-control" id="name">
    </div>
    <div class="mb-3">
        <label for="password" class="form-label">Mot de passe</label>
        <input name="mdp" type="password" class="form-control" id="password">
    </div>
    <button name="submit" type="submit" class="btn btn-primary">Se connecter</button>
</form>

<?php
require_once '../layouts/footer.php';
?>
