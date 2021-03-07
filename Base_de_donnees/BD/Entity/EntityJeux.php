<?php

    include './Connexion/connexion.php';

    function getJeux($con) 
    {
        $class = new Connexion();
        $this->connexion = $class->getConnexion();
    }

    public function getJeux(): array
    {
        try {
            $request = "select j.id_jeu, nom, developpeur, editeur, prix, rabais, date_de_sortie, image_lien, categorie
                        from jeux j
                        inner join jeux_categories c 
                        on j.id_jeu = c.id_jeu;";
            $result = $this->connexion->query($request);
            $items = $result->fetchAll();
            return $items;
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

    public function getJeuxRecommandees(): array
    {
        try {
            $request = "select j.id_jeu, nom, developpeur, editeur, rating, prix, rabais, date_de_sortie, image_lien, categorie
                        from jeux j
                        inner join jeux_categories c 
                        on j.id_jeu = c.id_jeu
                        order by rabais
                        limit 3;";
            $result = $this->connexion->query($request);
            $items = $result->fetchAll();
            return $items;
        }
        catch(PDOException $e) {
            return $items;
        }
    }

    public function getNbrPersonnes(string $id):array{
        $items = array();
        try {
            $request = "select count(id_jeu) as nbrPersonnes
                        from utilisateurs_jeux
                        where id_jeu = '$id';";
            $result = $this->connexion->query($request);
            $items = $result->fetchAll();
            return $items;
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
    