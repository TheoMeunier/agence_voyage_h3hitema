<?php

require_once '../../src/Controller/VoyagesController.php';

$tags_list = findAll('TAG', 'name');
$destinations_list = findAll('DESTINATION', 'name');

if(isSubmit()){
    // Boucle qui récupère les données et crée les variables
    foreach (getValues() as $field => $value){
        ${$field} = $value;
    }
    $image = $_FILES['image']['name'];

    if (isNotBlank($destination_id) && isNotBlank($description)){
        if(!Exist('TRAVEL', 'name', $title)){
            if (isNotBlank($tags) && count($tags) > 0){
                $tags_id = ' ' . implode(' ', $tags) . ' ';
                $data = [
                    'name' => $title,
                    'image' => $image,
                    'description' => $description,
                    'created_at' => date('y-m-d h:i:s'),
                    'tags' => $tags_id,
                    'destination_id' => $destination_id
                ];
                create('TRAVEL', $data);
                processFileForm();
            } else{
                alert('error', 'Veuillez attribuer au moins un tag au voyage');
            }
        }else{
            alert('error', 'Ce voyage existe déjà');
        }
    } else{
        alert('error', 'Veuillez remplir tous les champs svp');
    }

    Redirect(); exit;
}

require_once '../../layouts/admin/header.php';

displayMessages()
?>

    <div class="d-flex justify-content-between align-items-center w-100 mb-4 underline">
        <h1>Gestion des voyages</h1>
        <a href="index.php" class="btn btn-primary">Liste des voyages</a>
    </div>

        <h2 class="text-center">Ajouter un voyage</h2>

        <form action="" method="post" enctype="multipart/form-data" class="mt-3">

            <div class="mb-3">
                <select class="form-select" name="destination_id">
                    <option selected value="">Sélectionnez la destination correspondante</option>
                    <?php foreach ($destinations_list as $destination_list):  ?>
                        <option value="<?= $destination_list['id'] ?>"><?= $destination_list['name'] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="title" class="from-label">Titre</label>
                <input type="text" class="form-control" name="title" required>
            </div>
            <div class="mb-3">
                <label class="form-label" for="">Options</label>
                <div class="checkbox">
                    <?php foreach ($tags_list as $tag_list):  ?>
                        <div class="input-group-text" style="margin-bottom: .3rem;">
                            <label><input type="checkbox" value="<?= $tag_list['id']; ?>" name="tags[]"> <?= $tag_list['name']; ?> </label>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
            <div class="mb-3">
                <label class="form-label" for="image">Image</label>
                <input type="file" name="image" class="form-control" accept="image/png, image/jpg, image/jpeg, image/svg" required>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control" id="description" name="description" rows="3"></textarea>
            </div>
            <div>
                <button type="submit" class="btn btn-primary" name="submit">Créer</button>
            </div>
        </form>

<?php
require_once '../../layouts/admin/footer.php';
?>