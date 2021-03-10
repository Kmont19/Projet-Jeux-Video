<?php
require_once ('BD/Models/ModelPanier.php');
$modelPanier = new ModelPanier();
echo json_encode($modelPanier->ajoutPanier($_POST['id_panier'],
                                           $_POST['email_client']));