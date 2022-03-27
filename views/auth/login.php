<?php

session_start();

require_once '../../db.php';

if(isset($_POST['submit'])){

    $nom = $_POST['nom'];
    $mdp = hash('sha256', $_POST['mdp']);

    $req = $pdo->query("SELECT id FROM `user` WHERE name = '$nom' AND password = '$mdp'");
    $data = $req->fetch(PDO::FETCH_ASSOC);

    if($req->rowCount() > 0){
        $_SESSION['id'] = $data['id'];
        header('location:../admin/options/index.php');
    }else{
        $messages[] = "L'identifiant ou le mot de passe est incorrecte";
    }
}

require_once '../layouts/admin-header.php';
?>
    
    <section class="content">
        <div class="form">
            <h1 class="titre">Connexion</h1>
            <form action="" method="post">
                <?php
                    if(isset($messages)){
                        foreach($messages as $message){
                            echo '<div class="message">'.$message.'</div>';
                        };
                    };
                ?>
                <input name="nom" type="text" class="champ" placeholder="Identifiant">
                <input name="mdp" type="password" class="champ" placeholder="Mot de passe">
                <button name="submit" type="submit" class="btn btn-primary">Se connecter</button>
            </form>
        </div>
    </section>

<?php
require_once '../layouts/admin-footer.php';
?>
