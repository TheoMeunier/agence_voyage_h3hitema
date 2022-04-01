<?php

require_once '../../../db.php';
require_once '../is_connected.php';
require_once '../is_messages.php';

if(isset($_GET['edit'])){
    $edit_id = $_GET['edit'];
    $edit_query = $pdo->query("SELECT id,name,email,password FROM user WHERE id = '$edit_id'")->fetch(PDO::FETCH_ASSOC);
}else{
    header('location:index.php');
};

if(isset($_POST['submit'])){
    $old_name = $edit_query['name'];
    $old_email = $edit_query['email'];
    $old_password = $edit_query['password'];
    $new_name = $_POST['name'];
    $new_email = $_POST['email'];
    $last_password = hash('sha256', $_POST['last_password']);
    $new_password = hash('sha256', $_POST['new_password']);
    $cpassword = hash('sha256', $_POST['cpassword']);

    if($new_name != ""){
        $vname = $pdo->query("SELECT id FROM user WHERE name = '$new_name'");
        if($old_name != $new_name && $vname->rowCount() > 0){
            $errors[] = 'Cet identifiant est déjà utilisé';
        }else if($old_name != $new_name && $vname->rowCount() <= 0){
            $insert = $pdo->query("UPDATE user SET name = '$new_name' WHERE id = '$edit_id'");
            if(!$insert){
                $errors[] = 'Une erreur est survenue dans la modification du nom';
            }else{
                $successes[] = "Le nom a bien été modifié";
            }
        }
    }
    if($new_email != ""){
        $vemail = $pdo->query("SELECT id FROM user WHERE email = '$new_email'");
        if($old_email != $new_email && $vemail->rowCount() > 0){
            $errors[] = 'Cet email est déjà utilisé';
        }else if($old_email != $new_email && $vemail->rowCount() <= 0){
            $insert = $pdo->query("UPDATE user SET email = '$new_email' WHERE id = '$edit_id'");
            if(!$insert){
                $errors[] = "Une erreur est survenue dans la modification de l'email";
            }else{
                $successes[] = "L'email a bien été modifié";
            }
        }
    }
    if ($last_password != "e3b0c44298fc1c149afbf4c8996fb92427ae41e4649b934ca495991b7852b855"){
        if ($old_password == $last_password){
            if ($new_password != "e3b0c44298fc1c149afbf4c8996fb92427ae41e4649b934ca495991b7852b855"){
                if ($new_password == $cpassword){
                    $insert = $pdo->query("UPDATE user SET password = '$new_password' WHERE id = '$edit_id'");
                    if (!$insert){
                        $errors[] = "Une erreur est survenue dans la modification du mdp";
                    } else {
                        $successes[] = "Le mdp a bien été modifié";
                    }
                } else {
                    $errors[] = 'Les deux nouveaux mdp ne correspondent pas';
                }
            } else {
                $errors[] = 'Veuillez indiquer le nouveau mdp';
            }
        } else if ($old_password != $last_password){
            $errors[] = "L'ancien mdp ne correspond pas à celui indiqué";
        }
    }else{
        if($new_password != "e3b0c44298fc1c149afbf4c8996fb92427ae41e4649b934ca495991b7852b855"){
            $errors[] = 'Entrez l\'ancien mdp pour pouvoir le modifier';
        }
    }
}

if (isset($successes) && !isset($errors)){
    $_SESSION['successes'] = $successes;
    header('location:index.php');
} else if (isset($successes) && isset($errors)){
    $_SESSION['errors'] = $errors;
    $_SESSION['successes'] = $successes;
    header('location:edit.php?edit='.$edit_id);
} else if (!isset($successes) && isset($errors)){
    $_SESSION['errors'] = $errors;
    header('location:edit.php?edit='.$edit_id);
}

require_once '../../../views/layouts/admin/header.php';

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
        <h1>Gestion des comptes</h1>
        <a href="index.php" class="btn btn-primary">Liste des comptes</a>
    </div>

    <h2 class="text-center">Modifier un compte</h2>

    <!-- on liste tous les utilisateurs -->
    <form action="" method="post" class="mt-3">
        <div class="mb-3">
            <label for="nom" class="form-label">Nom</label>
            <input type="text" id="name" class="form-control" name="name" value="<?=$edit_query['name'];?>">
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" id="email" class="form-control" name="email" value="<?=$edit_query['email'];?>">
        </div>
        <div class="mb-3">
            <label for="last_password" class="form-label">Mot de passe actuel</label>
            <input type="password" id="last_password" class="form-control" name="last_password">
        </div>
        <div class="mb-3">
            <label for="new_password" class="form-label">Nouveau mot de passe</label>
            <input type="password" id="new_password" class="form-control" name="new_password">
        </div>
        <div class="mb-3">
            <label for="cpassword" class="form-label">Confirmation du mot de passe</label>
            <input type="password" id="cpassword" class="form-control" name="cpassword">
        </div>
        <button type="submit" name="submit" class="btn btn-success">Modifier</button>
    </form>

<?php require_once '../../../views/layouts/admin/footer.php'; ?>