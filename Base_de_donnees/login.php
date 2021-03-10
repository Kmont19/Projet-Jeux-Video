<?php
require_once(__DIR__ . "/BD/Entity/EntityUtilisateur.php");
$entityUtilisateurs = new EntityUtilisateur();
echo json_encode(array("item" => $entityUtilisateurs->verifUtilisateur($_POST["email"], $_POST["motdepasse"])));
