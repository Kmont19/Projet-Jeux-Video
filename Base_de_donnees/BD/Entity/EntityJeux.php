<?php
    require_once (__DIR__.'/../Connexion/Connexion.php');

    class EntityJeux 
    {
        private $connexion;

        /**
        * EntityJeux constructor.
        */
        public function __construct() 
        {
            $class = new Connexion();
            $this->connexion = $class->getConnexion();
        }

        public function getJeux() 
        {
            try {
                $stmt = $this->connexion->prepare("SELECT * FROM jeux ORDER BY date_de_sortie");
                $stmt->execute();
                $jeux = $stmt->fetchAll();
                return $jeux;
            } catch (PDOException $e) {
                echo "Échec lors de la connexion à la base de données: " . $e->getMessage();
            }
        }

        public function getJeuxByNom(string $nom) 
        {
            try {
                $nomLike = '%'.$nom.'%';
                $stmt = $this->connexion->prepare('SELECT * FROM jeux WHERE nom LIKE :nom');
                $stmt->execute(['nom' => $nomLike]);
                $jeux = $stmt->fetchAll();
                return $jeux;
            } catch (PDOException $e) {
                echo "Échec lors de la connexion à la base de données: " . $e->getMessage();
            }
        }

        public function getJeuxByCategorie(string $categorie) 
        {
            try {
                $stmt = $this->connexion->prepare('SELECT * FROM jeux j
                            INNER JOIN jeux_categories jc on j.id_jeu = jc.id_jeu
                            WHERE jc.categorie= :categorie');
                $stmt->execute(['categorie' => $categorie]);
                $jeux = $stmt->fetchAll();
                return $jeux;
            } catch (PDOException $e) {
                echo "Échec lors de la connexion à la base de données: " . $e->getMessage();
            }
        }

        public function getJeuxByEditeur(string $editeur)
        {
            try {
                $stmt = $this->connexion->prepare("SELECT * FROM jeux WHERE editeur= :editeur");
                $stmt->execute(['editeur' => $editeur]);
                $jeux = $stmt->fetchAll();
                return $jeux;
            } catch (PDOException $e) {
                echo "Échec lors de la connexion à la base de données: " . $e->getMessage();
            }
        }

        public function getJeuxByDeveloppeur(string $developpeur)
        {
            try {
                $stmt = $this->connexion->prepare("SELECT * FROM jeux WHERE developpeur= :developpeur");
                $stmt->execute(['developpeur' => $developpeur]);
                $jeux = $stmt->fetchAll();
                return $jeux;
            } catch (PDOException $e) {
                echo "Échec lors de la connexion à la base de données: " . $e->getMessage();
            }
        }

        public function getJeuxByRating(int $rating)
        {
            try {
                $stmt = $this->connexion->prepare("SELECT * FROM jeux WHERE rating= :rating");
                $stmt->execute(['rating' => $rating]);
                $jeux = $stmt->fetchAll();
                return $jeux;
            } catch (PDOException $e) {
                echo "Échec lors de la connexion à la base de données: " . $e->getMessage();
            }
        }

        public function getJeuxByPrix($prixMin, $prixMax)
        {
            try {
                $stmt = $this->connexion->prepare("SELECT * FROM jeux WHERE prix BETWEEN :prixMin AND :prixMax");                
                $stmt->execute(array('prixMin' => $prixMin, 'prixMax' => $prixMax));
                $jeux = $stmt->fetchAll();
                return $jeux;
            } catch (PDOException $e) {
                echo "Échec lors de la connexion à la base de données: " . $e->getMessage();
            }
        }

        public function getJeuxByPlusRecent()
        {
            try {
                $stmt = $this->connexion->prepare("SELECT * FROM jeux ORDER BY date_de_sortie DESC");
                $stmt->execute();
                $jeux = $stmt->fetchAll();
                return $jeux;
            } catch (PDOException $e) {
                echo "Échec lors de la connexion à la base de données: " . $e->getMessage();
            }
        }

        public function getJeuxByPlusAnciens()
        {
            try {
                $stmt = $this->connexion->prepare("SELECT * FROM jeux ORDER BY date_de_sortie ASC");
                $stmt->execute();
                $jeux = $stmt->fetchAll();
                return $jeux;
            } catch (PDOException $e) {
                echo "Échec lors de la connexion à la base de données: " . $e->getMessage();
            }
        }

        public function getJeuxByPrixASC()
        {
            try {
                $stmt = $this->connexion->prepare("SELECT * FROM jeux ORDER BY prix ASC");
                $stmt->execute();
                $jeux = $stmt->fetchAll();
                return $jeux;
            } catch (PDOException $e) {
                echo "Échec lors de la connexion à la base de données: " . $e->getMessage();
            }
        }

        public function getJeuxByPrixDESC()
        {
            try {
                $stmt = $this->connexion->prepare("SELECT * FROM jeux ORDER BY prix DESC");
                $stmt->execute();
                $jeux = $stmt->fetchAll();
                return $jeux;
            } catch (PDOException $e) {
                echo "Échec lors de la connexion à la base de données: " . $e->getMessage();
            }
        }    
    }


    