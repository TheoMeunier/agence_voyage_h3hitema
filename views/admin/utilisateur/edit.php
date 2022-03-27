<?php

require_once '../is_connected.php';
require_once '../../../db.php';

if(isset($_GET['edit'])){
    $edit_id = $_GET['edit'];
    $edit_query = $pdo->query("SELECT id,name,email,password FROM user WHERE id = '$edit_id'")->fetch(PDO::FETCH_ASSOC);
}else{
    header('location:index.php');
};

if(isset($_POST['submit'])){
    $old_name = $edit_query['name'];
    $old_email = $edit_query['email'];
    $old_mdp = $edit_query['password'];
    $new_name = $_POST['nom'];
    $new_email = $_POST['email'];
    $new_old_mdp = hash('sha256', $_POST['ancien_mdp']);
    $new_mdp = hash('sha256', $_POST['nouveau_mdp']);
    $cnew_mdp = hash('sha256', $_POST['cnouveau_mdp']);
    
    if($new_name != ""){
        $vname = $pdo->query("SELECT id FROM user WHERE name = '$new_name'");
        if($old_name != $new_name && $vname->rowCount() > 0){
            $erreurs[] = 'Cet identifiant est déjà utilisé';
        }else if($old_name != $new_name && $vname->rowCount() <= 0){
            $insert = $pdo->query("UPDATE user SET name = '$new_name' WHERE id = '$edit_id'");
            if(!$insert){
                $erreurs[] = 'Une erreur est survenue dans la modification du nom';
            }else{
                $succes[] = "Le nom a bien été modifié";
            }
        }
    }
    if($new_email != ""){
        $vemail = $pdo->query("SELECT id FROM user WHERE email = '$new_email'");
        if($old_email != $new_email && $vemail->rowCount() > 0){
            $erreurs[] = 'Cet email est déjà utilisé';
        }else if($old_email != $new_email && $vemail->rowCount() <= 0){
            $insert = $pdo->query("UPDATE user SET email = '$new_email' WHERE id = '$edit_id'");
            if(!$insert){
                $erreurs[] = "Une erreur est survenue dans la modification de l'email";
            }else{
                $succes[] = "L'email a bien été modifié";
            }
        }
    }
    if($new_old_mdp != "e3b0c44298fc1c149afbf4c8996fb92427ae41e4649b934ca495991b7852b855"){
        if($old_mdp == $new_old_mdp){
            if($new_mdp != "e3b0c44298fc1c149afbf4c8996fb92427ae41e4649b934ca495991b7852b855"){
                if($new_mdp == $cnew_mdp){
                    $insert = $pdo->query("UPDATE user SET password = '$new_mdp' WHERE id = '$edit_id'");
                    if(!$insert){
                        $erreurs[] = "Une erreur est survenue dans la modification du mdp";
                    }else{
                        $succes[] = "Le mdp a bien été modifié";
                    }
                }else{
                    $erreurs[] = 'Les deux nouveaux mdp ne correspondent pas';
                }
            }else{
                $erreurs[] = 'Veuillez indiquer le nouveau mdp';
            }
        }else if($old_mdp != $new_old_mdp){
            $erreurs[] = "L'ancien mdp ne correspond pas à celui indiqué";
        }
    }else{
        if($new_mdp != "e3b0c44298fc1c149afbf4c8996fb92427ae41e4649b934ca495991b7852b855"){
            $erreurs[] = 'Entrez l\'ancien mdp pour pouvoir le modifier';
        }
    }
}

require_once '../../../views/layouts/admin-header.php'
?>

<section class="content">

    <div class="heading">
        <h1>Gestion des comptes</h1>
        <a href="index.php" class="btn btn-primary">Liste des comptes</a>
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
                <label for="nom">Identifiant:</label>
                <input type="text" class="champ" name="nom" value="<?=$edit_query['name'];?>">
            </div>
            <div>
                <label for="email">Email:</label>
                <input type="email" class="champ" name="email" value="<?=$edit_query['email'];?>">
            </div>
            <div>
                <label for="mdp">Ancien MDP:</label>
                <input type="password" class="champ" name="ancien_mdp" placeholder="Ancien mdp">
            </div>
            <div>
                <label for="new_mdp">Nouveau MDP:</label>
                <input type="password" class="champ" name="nouveau_mdp" placeholder="Nouveau mdp">
            </div>
            <div>
                <label for="cnew_mdp">Répétez MDP:</label>
                <input type="password" class="champ" name="cnouveau_mdp" placeholder="Répétez mdp">
            </div>
            <input type="submit" name="submit" value="Modifier" class="btn btn-success"></a>
        </form>
    </div>
</section>

<?php require_once '../../../views/layouts/admin-footer.php'; ?>