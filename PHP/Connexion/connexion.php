<?php

    $con = connexion();

    function connexion() {
        try {
            //Serveur
            $connexion = new PDO("mysql:host=localhost;dbname=420617ri_gr01; charset=utf8", "1647207", "1647207");
            $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $connexion;
        } catch(PDOException $e) {
            echo "Échec de connexion à la base de données: ". $e->getMessage();
            }
    }
?>