<?php

    include './Connexion/connexion.php';

    function getJeux($con) 
    {
        try {
            $requete = "SELECT * FROM jeux";
            $resultat = $con->query($requete);
            $ligne = $resultat->fetchAll();
            return json_encode($ligne);
        } catch (PDOException $e) {
            echo "Échec lors de la connexion à la base de données: " . $e->getMessage();
        }
    }

    function getJeuxByCategorie($con, $categorie) 
    {
        try {
            $requete = "SELECT * FROM jeux j
                        INNER JOIN jeux_categories jc on j.id_jeu = jc.id_jeu
                        WHERE categorie=" . $categorie;
            $resultat = $con->query($requete);
            $ligne = $resultat->fetchAll();
            return json_encode($ligne);
        } catch (PDOException $e) {
            echo "Échec lors de la connexion à la base de données: " . $e->getMessage();
        }
    }

    function getJeuxByEditeur($con, $editeur)
    {
        try {
            $requete = "SELECT * FROM jeux WHERE editeur=" . $editeur;
            $resultat = $con->query($requete);
            $ligne = $resultat->fetchAll();
            return json_encode($ligne);
        } catch (PDOException $e) {
            echo "Échec lors de la connexion à la base de données: " . $e->getMessage();
        }
    }

    function getJeuxByDeveloppeur($con, $developpeur)
    {
        try {
            $requete = "SELECT * FROM jeux WHERE developpeur=" . $developpeur;
            $resultat = $con->query($requete);
            $ligne = $resultat->fetchAll();
            return json_encode($ligne);
        } catch (PDOException $e) {
            echo "Échec lors de la connexion à la base de données: " . $e->getMessage();
        }
    }

    function getJeuxByRating($con, $rating)
    {
        try {
            $requete = "SELECT * FROM jeux WHERE rating=" . $rating;
            $resultat = $con->query($requete);
            $ligne = $resultat->fetchAll();
            return json_encode($ligne);
        } catch (PDOException $e) {
            echo "Échec lors de la connexion à la base de données: " . $e->getMessage();
        }
    }

    function getJeuxUnder25($con)
    {
        try {
            $requete = "SELECT * FROM jeux WHERE prix <= 25";
            $resultat = $con->query($requete);
            $ligne = $resultat->fetchAll();
            return json_encode($ligne);
        } catch (PDOException $e) {
            echo "Échec lors de la connexion à la base de données: " . $e->getMessage();
        }
    }

    function getJeux25_50($con)
    {
        try {
            $requete = "SELECT * FROM jeux WHERE prix BETWEEN 25 and 50";
            $resultat = $con->query($requete);
            $ligne = $resultat->fetchAll();
            return json_encode($ligne);
        } catch (PDOException $e) {
            echo "Échec lors de la connexion à la base de données: " . $e->getMessage();
        }
    }

    function getJeux50_100($con)
    {
        try {
            $requete = "SELECT * FROM jeux WHERE prix BETWEEN 50 and 100";
            $resultat = $con->query($requete);
            $ligne = $resultat->fetchAll();
            return json_encode($ligne);
        } catch (PDOException $e) {
            echo "Échec lors de la connexion à la base de données: " . $e->getMessage();
        }
    }

    function getJeux100plus($con)
    {
        try {
            $requete = "SELECT * FROM jeux WHERE prix >= 100";
            $resultat = $con->query($requete);
            $ligne = $resultat->fetchAll();
            return json_encode($ligne);
        } catch (PDOException $e) {
            echo "Échec lors de la connexion à la base de données: " . $e->getMessage();
        }
    }

    function getJeuxByPlusRecent($con)
    {
        try {
            $requete = "SELECT * FROM jeux ORDER BY date_de_sortie DESC";
            $resultat = $con->query($requete);
            $ligne = $resultat->fetchAll();
            return json_encode($ligne);
        } catch (PDOException $e) {
            echo "Échec lors de la connexion à la base de données: " . $e->getMessage();
        }
    }

    function getJeuxByPlusAnciens($con)
    {
        try {
            $requete = "SELECT * FROM jeux ORDER BY date_de_sortie ASC";
            $resultat = $con->query($requete);
            $ligne = $resultat->fetchAll();
            return json_encode($ligne);
        } catch (PDOException $e) {
            echo "Échec lors de la connexion à la base de données: " . $e->getMessage();
        }
    }

    function getJeuxByPrixASC($con)
    {
        try {
            $requete = "SELECT * FROM jeux ORDER BY prix ASC";
            $resultat = $con->query($requete);
            $ligne = $resultat->fetchAll();
            return json_encode($ligne);
        } catch (PDOException $e) {
            echo "Échec lors de la connexion à la base de données: " . $e->getMessage();
        }
    }

    function getJeuxByPrixDESC($con)
    {
        try {
            $requete = "SELECT * FROM jeux ORDER BY prix DESC";
            $resultat = $con->query($requete);
            $ligne = $resultat->fetchAll();
            return json_encode($ligne);
        } catch (PDOException $e) {
            echo "Échec lors de la connexion à la base de données: " . $e->getMessage();
        }
    }
    
    if(isset($_GET['action'])) {
        switch($_GET['action']){
            case 'getJeux':
                echo getJeux($con);
            break;
            case 'getJeuxByCategorie':
                echo getJeuxByCategorie($con, $_GET['categorie']);
            break;
            case 'getJeuxByEditeur':
                echo getJeuxByEditeur($con, $_GET['editeur']);
            break;
            case 'getJeuxByRating':
                echo getJeuxByRating($con, $_GET['rating']);
            break;
            case 'getJeuxByDeveloppeur':
                echo getJeuxByDeveloppeur($con, $_GET['developpeur']);
            break;
            case 'getJeuxUnder25':
                echo getJeuxUnder25($con);
            break;
            case 'getJeux25_50':
                echo getJeux25_50($con);
            break;
            case 'getJeux50_100':
                echo getJeux50_100($con);
            break;
            case 'getJeux100plus':
                echo getJeux100plus($con);
            break;
            case 'getJeuxByPlusRecent':
                echo getJeuxByPlusRecent($con);
            break;
            case 'getJeuxByPlusAnciens':
                echo getJeuxByPlusAnciens($con);
            break;
            case 'getJeuxByPrixASC':
                echo getJeuxByPrixASC($con);
            break;
            case 'getJeuxByPrixDESC':
                echo getJeuxByPrixDESC($con);
            break;
            default:
        break;
        }
    }
    