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
                $stmt = $this->connexion->prepare("SELECT * FROM jeux");
                $stmt->execute();
                $jeux = $stmt->fetchAll();
                return $jeux;
            } catch (PDOException $e) {
                echo "Échec lors de la connexion à la base de données: " . $e->getMessage();
            }
        }

        public function getJeuxByCategorie(string $categorie) 
        {
            try {
                $stmt = $this->connexion->prepare("SELECT * FROM jeux j
                            INNER JOIN jeux_categories jc on j.id_jeu = jc.id_jeu
                            WHERE categorie=" . $categorie);

                $stmt->execute();
                $jeux = $stmt->fetchAll();
                return $jeux;
            } catch (PDOException $e) {
                echo "Échec lors de la connexion à la base de données: " . $e->getMessage();
            }
        }

        public function getJeuxByEditeur(string $editeur)
        {
            try {
                $stmt = $this->connexion->prepare("SELECT * FROM jeux WHERE editeur=" . $editeur);
                $stmt->execute();
                $jeux = $stmt->fetchAll();
                return $jeux;
            } catch (PDOException $e) {
                echo "Échec lors de la connexion à la base de données: " . $e->getMessage();
            }
        }

        public function getJeuxByDeveloppeur(string $developpeur)
        {
            try {
                $stmt = $this->connexion->prepare("SELECT * FROM jeux WHERE developpeur=" . $developpeur);
                $stmt->execute();
                $jeux = $stmt->fetchAll();
                return $jeux;
            } catch (PDOException $e) {
                echo "Échec lors de la connexion à la base de données: " . $e->getMessage();
            }
        }

        public function getJeuxByRating(int $rating)
        {
            try {
                $stmt = $this->connexion->prepare("SELECT * FROM jeux WHERE rating=" . $rating);
                $stmt->execute();
                $jeux = $stmt->fetchAll();
                return $jeux;
            } catch (PDOException $e) {
                echo "Échec lors de la connexion à la base de données: " . $e->getMessage();
            }
        }

        public function getJeuxUnder25()
        {
            try {
                $stmt = $this->connexion->prepare("SELECT * FROM jeux WHERE prix <= 25");
                $stmt->execute();
                $jeux = $stmt->fetchAll();
                return $jeux;
            } catch (PDOException $e) {
                echo "Échec lors de la connexion à la base de données: " . $e->getMessage();
            }
        }

        public function getJeux25_50()
        {
            try {
                $stmt = $this->connexion->prepare("SELECT * FROM jeux WHERE prix BETWEEN 25 and 50");
                $stmt->execute();
                $jeux = $stmt->fetchAll();
                return $jeux;
            } catch (PDOException $e) {
                echo "Échec lors de la connexion à la base de données: " . $e->getMessage();
            }
        }

        public function getJeux50_100()
        {
            try {
                $stmt = $this->connexion->prepare("SELECT * FROM jeux WHERE prix BETWEEN 50 and 100");
                $stmt->execute();
                $jeux = $stmt->fetchAll();
                return $jeux;
            } catch (PDOException $e) {
                echo "Échec lors de la connexion à la base de données: " . $e->getMessage();
            }
        }

        public function getJeux100plus()
        {
            try {
                $stmt = $this->connexion->prepare("SELECT * FROM jeux WHERE prix >= 100");
                $stmt->execute();
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


    