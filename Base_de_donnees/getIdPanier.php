<?php
require_once (__DIR__."/BD/Entity/EntityPanier.php");
$entityPanier = new EntityPanier();
echo json_encode(array("item" => $entityPanier->getIdPanier($_POST["email_client"])));