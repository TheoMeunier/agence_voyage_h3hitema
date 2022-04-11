<?php
require_once '../../src/Controller/UserController.php';

if(isset($_GET['id'])){
    $edit_id = $_GET['id'];
    $edit_query = find('USER', $edit_id);
}else{
    header('location:index.php');
};

if(isSubmit()){
    // Boucle pour obtenir les anciennes données
    foreach ($edit_query as $field => $value){
        ${'old_' . $field} = $value;
    }
    // Boucle pour obtenir les nouvelles données
    foreach (getValues() as $field => $value){
        ${$field} = $value;
    }

    checkName($new_name, $old_name, $edit_id);
    checkEmail($new_email, $old_email, $edit_id);
    checkPassword($new_password, $cpassword, $last_password, $old_password, $edit_id);

    Redirect(); exit;
}

require_once '../../layouts/admin/header.php';

displayMessages()
?>

    <div class="d-flex justify-content-between align-items-center w-100 mb-4 underline">
        <h1>Gestion des comptes</h1>
        <a href="index.php" class="btn btn-primary">Liste des comptes</a>
    </div>

    <h2 class="text-center">Modifier un compte</h2>

    <form action="" method="post" class="mt-3">
        <div class="mb-3">
            <label for="nom" class="form-label">Nom</label>
            <input type="text" id="name" class="form-control" name="new_name" value="<?=$edit_query['name'];?>">
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" id="email" class="form-control" name="new_email" value="<?=$edit_query['email'];?>">
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

<?php require_once '../../layouts/admin/footer.php'; ?>