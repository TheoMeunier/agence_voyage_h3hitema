<?php

require_once '../../src/Controller/VoyagesController.php';

if (isset($_GET['id'])) {
    $edit_id = $_GET['id'];
    $edit_query = find('DESTINATION', $edit_id);
} else {
    header('location:index.php');
};

$tags_list = findAll('TAG', 'name');

// Crée une liste à partir d'un string
$destination_tags = explode(" ", $edit_query['tags']);
// Enlève le premier et dernier élément de la liste qui sont des espaces
array_shift($destination_tags);
array_pop($destination_tags);

if (isSubmit()) {
    // Boucle pour obtenir les anciennes données
    foreach ($edit_query as $field => $value){
        ${'old_' . $field} = $value;
    }
    // Boucle pour obtenir les nouvelles données
    foreach (getValues() as $field => $value){
        ${'new_' . $field} = $value;
    }
    $new_image = $_FILES['image']['name'];

    checkTitle('DESTINATION', $new_title, $old_name, $edit_id);
    checkTags('DESTINATION', $new_tags, $destination_tags, $edit_id);
    checkDescription('DESTINATION', $new_description, $old_description, $edit_id);
    checkImage('DESTINATION', $new_image, $old_image, $edit_id);

    Redirect(); exit;
}

require_once '../../layouts/admin/header.php';

displayMessages()
?>

    <div class="d-flex justify-content-between align-items-center w-100 mb-4 underline">
        <h1>Gestion des destinations</h1>
        <a href="index.php" class="btn btn-primary">Liste des destinations</a>
    </div>

    <h2 class="text-center">Modifier la destination</h2>

        <form action="" method="post" enctype="multipart/form-data" class="mt-3">
            <div class="mb-3">
                <label class="form-label" for="nom">Titre</label>
                <input type="text" class="form-control" name="title" value="<?=$edit_query['name'];?>">
            </div>
            <div class="mb-3">
                <label class="form-label">Options</label>
                <div class="checkbox">
                    <?php foreach ($tags_list as $tag_list): ?>
                        <div class="input-group-text" style="margin-bottom: .3rem;">
                            <label><input <?= in_array($tag_list['id'], $destination_tags) ? 'checked' : ''; ?> type="checkbox" value="<?= $tag_list['id']; ?>" name="tags[]"> <?= $tag_list['name']; ?> </label>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
            <div class="mb-3">
                <label class="form-label" for="desc">Description</label>
                <textarea name="description" class="form-control" rows="3"><?=$edit_query['description'];?></textarea>
            </div>
            <div class="mb-3">
                <label class="form-label" for="img">Image</label>
                <input type="file" class="form-control" name="image" accept="image/png, image/jpg, image/jpeg, image/svg">
            </div>
            <button type="submit" name="submit" class="btn btn-success">Modifier</button>
        </form>

<?php require_once '../../layouts/admin/footer.php'; ?>