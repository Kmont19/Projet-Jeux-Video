<?php
require_once ("BD/Entity/EntityJeux.php");
$entityJeux = new EntityJeux();

if(isset($_GET["getJeux"])) {
    echo json_encode($entityJeux->getJeux());
}

if(isset($_GET["categorie"])) {
    echo json_encode($entityJeux->getJeuxByCategorie($_GET['categorie']));
}