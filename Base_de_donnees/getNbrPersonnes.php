<?php
require_once (__DIR__."/BD/Entity/EntityJeux.php");
$entityJeux = new EntityJeux();
echo json_encode(array("item" => $entityJeux->getNbrPersonnes($_POST["id_jeu"])));