<?php
require_once ("BD/Entity/EntityJeux.php");
$entityJeux = new EntityJeux();

if(isset($_GET["getJeux"])) {
    echo json_encode($entityJeux->getJeux());
}

if(isset($_GET["categorie"])) {
    echo json_encode($entityJeux->getJeuxByCategorie($_GET['categorie']));
}

if(isset($_GET["nom"])) {
    echo json_encode($entityJeux->getJeuxByNom($_GET['nom']));
}

if(isset($_GET["recherchePrix"])) {
    echo json_encode($entityJeux->getJeuxByPRix($_GET['prixMin'], $_GET['prixMax']));
}