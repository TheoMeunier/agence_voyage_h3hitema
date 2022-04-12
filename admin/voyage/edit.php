<?php

require_once '../../src/Controller/VoyagesController.php';

if (isset($_GET['id'])) {
    $edit_id = $_GET['id'];
    $edit_query = find('TRAVEL', $edit_id);
} else {
    header('location:index.php');
};

$tags_list = findAll('TAG', 'name');
$destinations_list = findAll('DESTINATION', 'name');

// Crée une liste à partir d'un string
$travel_tags = explode(" ", $edit_query['tags']);
// Enlève le premier et dernier élément de la liste qui sont des espaces
array_shift($travel_tags);
array_pop($travel_tags);

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

    checkTitle('TRAVEL', $new_title, $old_name, $edit_id);
    checkTags('TRAVEL', $new_tags, $travel_tags, $edit_id);
    checkDescription('TRAVEL', $new_description, $old_description, $edit_id);
    checkImage('TRAVEL', $new_image, $old_image, $edit_id);
    checkDestination_id('TRAVEL', $new_destination_id, $old_destination_id, $edit_id);

    Redirect(); exit;
}

require_once '../../layouts/admin/header.php';

displayMessages()
?>

    <div class="d-flex justify-content-between align-items-center w-100 mb-4 underline">
        <h1>Gestion des voyages</h1>
        <a href="index.php" class="btn btn-primary">Liste des voyages</a>
    </div>

    <h2 class="text-center">Modifier le voyage</h2>

        <form action="" method="post" enctype="multipart/form-data" class="mt-3">
            <div class="mb-3">
                <select class="form-select" name="destination_id">
                    <option selected value="">Sélectionnez la destination correspondante</option>
                    <?php foreach ($destinations_list as $destination_list):  ?>
                        <option <?= $destination_list['id'] == $edit_query['destination_id'] ? 'selected' : '' ?> value="<?= $destination_list['id'] ?>"><?= $destination_list['name'] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label" for="nom">Titre</label>
                <input type="text" class="form-control" name="title" value="<?=$edit_query['name'];?>">
            </div>
            <div class="mb-3">
                <label class="form-label">Options</label>
                <div class="checkbox">
                    <?php foreach ($tags_list as $tag_list): ?>
                        <div class="input-group-text" style="margin-bottom: .3rem;">
                            <label><input <?= in_array($tag_list['id'], $travel_tags) ? 'checked' : ''; ?> type="checkbox" value="<?= $tag_list['id']; ?>" name="tags[]"> <?= $tag_list['name']; ?> </label>
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