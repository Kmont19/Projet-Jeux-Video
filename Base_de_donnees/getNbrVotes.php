<?php
require_once (__DIR__."/BD/Entity/EntityJeux.php");
$entityJeux = new EntityJeux();
echo json_encode($entityJeux->getNbrVotes($_POST["id"]));