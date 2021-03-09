<?php
    include './Connexion/connexion.php';

    function getUserByEmail($email, $con) {
        $requete = "SELECT * FROM utilisateurs where email=" . $email;
        $resultat = $con->query($requete);
        $ligne = $resultat->fetch();
        return json_encode($ligne);
    }

    if(isset($_GET['action'])) {
        switch($_GET['action']){
            case 'getUserByEmail':
                echo getUserByEmail($_GET['email'], $con);
            break;
            default:
        break;
        }
    }