<?php
require_once ('BD/Models/ModelJeux.php');
$modelJeux = new ModelJeux();
echo json_encode($modelJeux->ajoutNote($_POST['email'],
                                       $_POST['id_jeu'],
                                       $_POST['note'],
                                       $_POST['avis']));