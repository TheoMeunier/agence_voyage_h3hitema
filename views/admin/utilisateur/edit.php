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
    
    if($new_name != ""){
        $vname = $pdo->query("SELECT id FROM user WHERE name = '$new_name'");
        if($old_name != $new_name && $vname->rowCount() > 0){
            $messages[] = 'Cet identifiant est déjà utilisé';
        }else if($old_name != $new_name && $vname->rowCount() <= 0){
            $insert = $pdo->query("UPDATE user SET name = '$new_name' WHERE id = '$edit_id'");
            if(!$insert){
                $messages[] = 'Une erreur est survenue dans la modification du nom';
            }else{
                $messages[] = "Le nom a bien été modifié";
            }
        }
    }
    if($new_email != ""){
        $vemail = $pdo->query("SELECT id FROM user WHERE email = '$new_email'");
        if($old_email != $new_email && $vemail->rowCount() > 0){
            $messages[] = 'Cet email est déjà utilisé';
        }else if($old_email != $new_email && $vemail->rowCount() <= 0){
            $insert = $pdo->query("UPDATE user SET email = '$new_email' WHERE id = '$edit_id'");
            if(!$insert){
                $messages[] = "Une erreur est survenue dans la modification de l'email";
            }else{
                $messages[] = "L'email a bien été modifié";
            }
        }
    }
    if($new_old_mdp != "e3b0c44298fc1c149afbf4c8996fb92427ae41e4649b934ca495991b7852b855"){
        if($old_mdp == $new_old_mdp){
            if($new_mdp != "e3b0c44298fc1c149afbf4c8996fb92427ae41e4649b934ca495991b7852b855"){
                $insert = $pdo->query("UPDATE user SET password = '$new_mdp' WHERE id = '$edit_id'");
                if(!$insert){
                    $messages[] = "Une erreur est survenue dans la modification du mdp";
                }else{
                    $messages[] = "Le mdp a bien été modifié";
                }
            }else{
                $messages[] = 'Veuillez indiquer le nouveau mdp';
            }
        }else if($old_mdp != $new_old_mdp){
            $messages[] = "L'ancien mdp ne correspond pas à celui indiqué";
        }
    }
}

require_once '../../../views/layouts/header.php'
?>

<?php

    if(isset($messages)){
        foreach($messages as $message){
            echo '<div>'.$message.'</div>';
        }
    }

?>

    <div>
        <div class="d-flex justify-content-between align-items-center">
            <h1>Gestion des comptes</h1>
            <a href="index.php" class="btn btn-primary">Liste des comptes</a>
        </div>
        <!-- on liste tous les utilisateurs -->
        <table class="table">
            <thead>
            <tr>
                <th>id</th>
                <th>Nom</th>
                <th>Email</th>
                <th>Mot de passe</th>
                <th>action</th>
            </tr>
            </thead>

            <tbody>
                <form action="" method="post">
                    <tr>
                        <td><?= $edit_query['id']; ?></td>
                        <td><input type="text" name="nom" value="<?=$edit_query['name'];?>"></td>
                        <td><input type="email" name="email" value="<?=$edit_query['email'];?>"></td>
                        <td>
                            <input type="password" name="ancien_mdp" placeholder="Ancien mdp">
                            <input type="password" name="nouveau_mdp" placeholder="Nouveau mdp">
                        </td>
                        <td><input type="submit" name="submit" value="Modifier" class="btn btn-success"></a></td>
                    </tr>
                </form>
            </tbody>
        </table>
    </div>

<?php require_once '../../../views/layouts/footer.php'; ?>