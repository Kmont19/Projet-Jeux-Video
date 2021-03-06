<?php
require_once ('BD/Models/ModelJeux.php');
$modelJeux = new ModelJeux();
echo json_encode($modelJeux->updateCategorie($_POST['id_jeu'],
    $_POST['categorie']));