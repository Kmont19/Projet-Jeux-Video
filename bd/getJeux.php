<?php
require_once (__DIR__."/DB/Entity/EntityJeux.php");
$entityJeux = new EntityJeux();
echo json_encode(array("item" => $entityJeux->getActivities()));