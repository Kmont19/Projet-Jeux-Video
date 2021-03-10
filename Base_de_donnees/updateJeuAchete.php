<?php
require_once ('BD/Models/ModelJeux.php');
$modelJeux = new ModelJeux();
echo json_encode($modelJeux->updateJeuAchete($_POST['id_jeu']));