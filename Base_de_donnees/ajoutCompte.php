<?php
require_once ('BD/Models/ModelCompte.php');
$modelCompte = new ModelCompte();
echo json_encode($modelCompte->ajoutCompte($_POST['email'],
                                           $_POST['pseudo'],
                                           $_POST['motdepasse']));