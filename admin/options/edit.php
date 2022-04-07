<?php

require_once '../../db.php';
require_once '../is_connected.php';
require_once '../is_messages.php';

$id = $_GET['id'];
$tag = $pdo->query("SELECT id,name FROM TAG WHERE id = '$id'")->fetch(PDO::FETCH_ASSOC);

if (isset($_POST['submit'])) {
    $name = $_POST['name'];

    if ($name != null){
        $vname = $pdo->query("SELECT name FROM TAG WHERE name = '$name'");

        if ($vname->rowCount() <= 0) {
            $sql = "UPDATE TAG SET name = '$name' WHERE id = '$id'";
            $pdo->query($sql);
            $successes[] = 'Le tag à bien été modifié';
        } else{
            $errors[] = 'Ce tag existe déjà';
        }

    } else {
        $errors[] = 'Veuillez donner un nom valide au tag';
    }
}

if (isset($successes) && !isset($errors)){
    $_SESSION['successes'] = $successes;
    header('location:index.php');
} else if (isset($successes) && isset($errors)){
    $_SESSION['errors'] = $errors;
    $_SESSION['successes'] = $successes;
    header('location:edit.php?id=' . $id);
} else if (!isset($successes) && isset($errors)){
    $_SESSION['errors'] = $errors;
    header('location:edit.php?id=' . $id);
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
    <h1>Gestion des options</h1>
    <a href="index.php" class="btn btn-primary">Liste des options</a>
</div>

<h2 class="text-center">Modifier un tag</h2>

<form action="" method="post">
    <div class="mb-2">
        <label for="" class="form-label">Nom</label>
        <input class="form-control" name="name" value="<?= $tag['name'] ?>">
    </div>
    <div>
        <button type="submit" name="submit" class="btn btn-primary">Modifier</button>
    </div>
</form>

<?php
require_once '../../layouts/admin/footer.php';
?>
