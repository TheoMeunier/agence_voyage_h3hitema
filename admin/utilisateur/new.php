<?php

require_once '../../src/Controller/UserController.php';

if(isSubmit()){
    
    foreach (getValues() as $field => $value){
        ${$field} = $value;
    }

    if (isNotBlank($name) && isNotBlank($email) && isNotBlank($password) && isNotBlank($cpassword)){
        if (validName($name) && validEmail($email) && validPassword($password, $cpassword)){
            $data = [
                'name' => $name,
                'email' => $email,
                'password' => hash('sha256', $password),
                'is_admin' => 1,
                'created_at' => date('y-m-d h:i:s')
            ];
            create('user', $data);
        }
    } else{
        alert('error', 'Veuillez remplir tous les champs svp');
    }

    setMessages(); exit;
}

require_once '../../layouts/admin/header.php';

displayMessages();
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