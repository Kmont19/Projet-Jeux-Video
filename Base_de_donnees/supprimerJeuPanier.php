<?php
require_once ('BD/Models/ModelPanier.php');
$modelPanier = new ModelPanier();
echo json_encode($modelPanier->supprimerJeuPanier($_POST["id_panier"],
                                                  $_POST['id_jeu']));