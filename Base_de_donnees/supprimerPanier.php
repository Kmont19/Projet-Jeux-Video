<?php
require_once ('BD/Models/ModelPanier.php');
$modelPanier = new ModelPanier();
echo json_encode($modelPanier->viderPanier($_POST['id_panier']));