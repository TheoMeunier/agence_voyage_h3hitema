<?php

// CE FICHIER NOUS MONTRE COMMENT RECUPERER LES DESTINATIONS ET VOYAGES GRACE AUX TAGS
// PRATIQUE POUR CELUI QUI FERA LES BARRES DE RECHERCHES

require_once 'db.php';

$sql="SELECT id,name FROM TAG ORDER BY name ASC";
$tags_list = $pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);

if (isset($_POST['submit'])){

    $tag = $_POST['tag'];

    $vtag = $pdo->query("SELECT id,name FROM TAG WHERE name = '$tag'")->fetch(PDO::FETCH_ASSOC);

    if (!empty($vtag) && count($vtag) > 0){
        $vtag_id = $vtag['id'];
        $destinations = $pdo->query("SELECT id,name FROM DESTINATION WHERE tags LIKE '% $vtag_id %'")->fetchAll(PDO::FETCH_ASSOC);
        foreach ($destinations as $destination){
            echo $destination['id'] . ' : ' . $destination['name'] . '<br>';
        }
    } else{
        echo 'existe pas';
    }
}
?>
    
        <form action="" method="post" class="mt-3">

            <input type="text" name="tag">
            <div>
                <button type="submit" class="btn btn-primary" name="submit">Créer</button>
            </div>
        </form>
