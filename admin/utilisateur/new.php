<?php

require_once '../../src/Controller/UserController.php';

if(isSubmit()){

    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = hash('sha256', $_POST['password']);
    $cpassword = hash('sha256', $_POST['cpassword']);

    $vname = findWhere('USER', 'name', $name);
    $vemail = findWhere('USER', 'email', $email);

    if (strlen($name) > 0 && strlen($email) > 0 && $password != 'e3b0c44298fc1c149afbf4c8996fb92427ae41e4649b934ca495991b7852b855'){
        if($vname->rowCount() > 0){
            $errors[] = 'Cet utilisateur existe déjà !';
        }else{
            if($vemail->rowCount() > 0){
                $errors[] = 'Cette addresse mail est déjà utilisée !';
            }else{
                if($password != $cpassword){
                    $errors[] = 'Les MDP ne correspondent pas !';
                }else{
                    $insert = $pdo->query("INSERT INTO user(name,email,password,is_admin,created_at) VALUES('$name','$email','$password', 1, NOW())");
    
                    if($insert){
                        $successes[] = 'Le compte a bien été créé';
                    }else{
                        $errors[] = "La création du compte a échoué";
                    };
                };
            };
        };
    } else{
        $errors[] = 'Veuillez remplir tous les champs svp';
    }
};

if (isset($successes) && !isset($errors)){
    $_SESSION['successes'] = $successes;
    header('location:index.php');
} else if (isset($successes) && isset($errors)){
    $_SESSION['errors'] = $errors;
    $_SESSION['successes'] = $successes;
    header('location:new.php'.$edit_id);
} else if (!isset($successes) && isset($errors)){
    $_SESSION['errors'] = $errors;
    header('location:new.php'.$edit_id);
}

require_once '../../layouts/admin/header.php';

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

    <h2 class="text-center">Créer un compte</h2>

    <form action="" method="post" class="mt-3">
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