<?php
require_once ('BD/Models/ModelPanier.php');
$modelPanier = new ModelPanier();
echo json_encode($modelPanier->ajoutJeuDansFacture($_POST['id_facture'],
    $_POST['id_jeu']));