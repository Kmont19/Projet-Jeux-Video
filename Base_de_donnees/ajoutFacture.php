<?php
require_once ('BD/Models/ModelPanier.php');
$modelPanier = new ModelPanier();
echo json_encode($modelPanier->ajoutFacture($_POST['id_facture'],
                                            $_POST['email_client']));