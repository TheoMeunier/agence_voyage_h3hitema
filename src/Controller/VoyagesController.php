<?php

require_once '../../src/Services/isConnected.php';
require_once '../../src/Table/Table.php';
require_once '../../src/Services/Alert.php';
require_once '../../src/Services/ValidationForm.php';
require_once '../../src/Services/UploadFile.php';

function validDescription(string $description):bool
{
    $isValid = false;
    if(strlen($description) < 300){
        $isValid = true;
    } else{
        alert('error', 'La description est trop longue (300 caractères max)');
    }

    return $isValid;
}

function validTitle(string $table, string $where, string $name):bool{
    $IsValid = false;
    if (!Exist($table, $where, $name)){
        if (strlen($name) > 3){
            $IsValid = true;
        } else{
            alert('error', 'Le titre du voyage est trop court');
        }
    } else{
        alert('error', 'Ce voyage existe déjà');
    }

    return $IsValid;
}

function checkTitle(string $table, string $new_title, string $old_title, int $edit_id):void
{
    if(isNotBlank($new_title)){
        if($old_title != $new_title){
            if (validTitle($table, 'name', $new_title)){
                $data = [
                    'name' => $new_title
                ];
                update($table, $data, $edit_id);
            }
        }
    } else{
        alert('error', 'Veuillez attribuer un titre valide au voyage');
    }
}

function checkDescription(string $table, string|null $new_description, string|null $old_description, int $edit_id):void
{
    if ($old_description != $new_description) {
        if (isNotBlank($new_description)){
            if (validDescription($new_description)){
                $data = [
                    'description' => $new_description
                ];
                update($table, $data, $edit_id);
            }
        } else{
            alert('error', 'Veuillez écrire une description valide');
        }
    }
}

function checkImage(string $table, string|null $new_image, string|null $old_image,int $edit_id):void
{
    if (isNotBlank($new_image)){
        if ($old_image != $new_image){
            $data = [
                'image' => $new_image
            ];
            update($table, $data, $edit_id);
            // removeFile($old_image); // Revoir car si l'image est utilisé 2 fois, elle sera supprimé et donc ne sera plus disponible pour l'autre élément.
            processFileForm();
        } else{
            alert('error', 'L\'image sélectionnée est celle actuelle');
        }
    }
}

function checkDestination_id(string $table, string|null $new_destination_id, string|null $old_destination_id, int $edit_id):void
{
    if ($old_destination_id != $new_destination_id){
        if (isNotBlank($new_destination_id)){
            $data = [
                'destination_id' => $new_destination_id
            ];
            update($table, $data, $edit_id);
        } else{
            alert('error', 'Veuillez sélectionner une destination valide');
        }
    }
}

function checkTags(string $table, array|null $new_tags, array|null $old_tags, int $edit_id):void
{
    if (isset($new_tags) && count($new_tags) > 0){
        if ($new_tags != $old_tags){
            $new_tags_id = " ";
            foreach ($new_tags as $new_tag){
                $new_tags_id = $new_tags_id . $new_tag . ' ';
            }
            $data = [
                'tags' => $new_tags_id
            ];
            update($table, $data, $edit_id);
        }
    } else{
        alert('error', 'Veuillez sélectionner au moins 1 tag pour ce voyage');
    }
}