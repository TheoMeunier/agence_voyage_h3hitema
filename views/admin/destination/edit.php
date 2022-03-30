<?php

require_once '../is_connected.php';
require_once '../../../db.php';

if(isset($_GET['edit'])){
    $edit_id = $_GET['edit'];
    $edit_query = $pdo->query("SELECT id,name,image,description FROM DESTINATION WHERE id = '$edit_id'")->fetch(PDO::FETCH_ASSOC);
}else{
    header('location:index.php');
};

require_once '../../../views/layouts/admin/header.php'
?>

    <h1>Modifier la destination</h1>

    <!-- on liste tous les utilisateurs -->
        <form action="" method="post">
            <div>
                <label for="nom">Titre</label>
                <input type="text" class="champ" name="titre" value="<?=$edit_query['name'];?>">
            </div>
            <div>
                <label for="desc">Description</label>
                <textarea name="desc" style="resize:none;" class="champ" rows="3"><?=$edit_query['description'];?></textarea>
            </div>
            <div>
                <label for="img">Image</label>
                <input type="file" class="champ" name="image" accept="image/png, image/jpg, image/jpeg, image/svg">
            </div>
            <button type="submit" name="submit" class="btn btn-success">Modifier</button>
        </form>

<?php require_once '../../../views/layouts/admin/footer.php'; ?>