<?php
    require_once (__DIR__.'/../Connexion.php');

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

        public function getNbrJeux() {
            try {
                $stmt = $this->connexion->prepare("SELECT COUNT(id_jeu) FROM jeux");
                $stmt->execute();
                $nbrJeux = $stmt->fetchColumn();
                return intval($nbrJeux);
            } catch  (PDOException $e) {
                return $e;
            }
        }

        public function getJeux() 
        {
            try {
                $stmt = $this->connexion->prepare("SELECT * FROM jeux j
                                                INNER JOIN jeux_categories jc
                                                ON j.id_jeu = jc.id_jeu
                                                ORDER BY date_de_sortie");
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
                $stmt = $this->connexion->prepare('SELECT * FROM jeux j
                                                INNER JOIN jeux_categories jc
                                                ON j.id_jeu = jc.id_jeu
                                                WHERE nom LIKE :nom 
                                                ORDER BY date_de_sortie');
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
                                                    WHERE jc.categorie= :categorie
                                                    ORDER BY date_de_sortie');
                $stmt->execute(['categorie' => $categorie]);
                $jeux = $stmt->fetchAll();
                return $jeux;
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
                            ORDER BY fois_achete DESC, date_de_sortie
                            limit 3;";
                $result = $this->connexion->query($request);
                $items = $result->fetchAll();
                return $items;
            }
            catch(PDOException $e) {
                return $items;
            } 
        }

        public function getJeuxByEditeur(string $editeur)
        {
            try {
                $stmt = $this->connexion->prepare("SELECT * FROM jeux j
                                                INNER JOIN jeux_categories jc
                                                ON j.id_jeu = jc.id_jeu
                                                WHERE editeur= :editeur 
                                                ORDER BY date_de_sortie");
                $stmt->execute(['editeur' => $editeur]);
                $jeux = $stmt->fetchAll();
                return $jeux;
            } catch (PDOException $e) {
                echo "Échec lors de la connexion à la base de données: " . $e->getMessage();
            }
        }

        //Page Accueil
        public function getNbrPersonnes(string $id):array{
            try {
                $request = "select count(id_jeu) as nbrPersonnes
                            from utilisateurs_jeux
                            where id_jeu = '$id';";
                $result = $this->connexion->query($request);
                $items = $result->fetchAll();
                return $items;
            } catch (PDOException $e) {
                echo "Échec lors de la connexion à la base de données: " . $e->getMessage();
            }
        }

        //Page Liste de jeux
        public function getNbrVotes($id){
            
            try {
                $request = "select count(id_jeu) as nbrPersonnes
                            from utilisateurs_jeux
                            where id_jeu = '$id';";
                $result = $this->connexion->prepare($request);
                $result-> execute();
                $count = $result->fetchColumn();
                return intval($count);

            } catch (PDOException $e) {
                echo "Échec lors de la connexion à la base de données: " . $e->getMessage();
            }
        }

        public function getJeuxByDeveloppeur(string $developpeur)
        {
            try {
                $stmt = $this->connexion->prepare("SELECT * FROM jeux j
                                                INNER JOIN jeux_categories jc
                                                ON j.id_jeu = jc.id_jeu
                                                WHERE developpeur= :developpeur 
                                                ORDER BY date_de_sortie");
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
                $stmt = $this->connexion->prepare("SELECT * FROM jeux j
                                                INNER JOIN jeux_categories jc
                                                ON j.id_jeu = jc.id_jeu 
                                                WHERE rating >= :rating 
                                                ORDER BY date_de_sortie");
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
                $stmt = $this->connexion->prepare("SELECT * FROM jeux j
                                                INNER JOIN jeux_categories jc
                                                ON j.id_jeu = jc.id_jeu 
                                                WHERE prix BETWEEN :prixMin AND :prixMax 
                                                ORDER BY date_de_sortie");                
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
                $stmt = $this->connexion->prepare("SELECT * FROM jeux j
                                                INNER JOIN jeux_categories jc
                                                ON j.id_jeu = jc.id_jeu 
                                                ORDER BY date_de_sortie DESC");
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
                $stmt = $this->connexion->prepare("SELECT * FROM jeux j
                                                INNER JOIN jeux_categories jc
                                                ON j.id_jeu = jc.id_jeu 
                                                ORDER BY date_de_sortie ASC");
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
                $stmt = $this->connexion->prepare("SELECT * FROM jeux j
                                                INNER JOIN jeux_categories jc
                                                ON j.id_jeu = jc.id_jeu 
                                                ORDER BY prix ASC");
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
                $stmt = $this->connexion->prepare("SELECT * FROM jeux j
                                                INNER JOIN jeux_categories jc
                                                ON j.id_jeu = jc.id_jeu 
                                                ORDER BY prix DESC");
                $stmt->execute();
                $jeux = $stmt->fetchAll();
                return $jeux;
            } catch (PDOException $e) {
                echo "Échec lors de la connexion à la base de données: " . $e->getMessage();
            }
        }    

        public function getJeuxByPromotions()
        {
            try {
                $stmt = $this->connexion->prepare("SELECT * FROM jeux j
                                                INNER JOIN jeux_categories jc
                                                ON j.id_jeu = jc.id_jeu 
                                                where rabais > 0
                                                ORDER BY date_de_sortie");
                $stmt->execute();
                $jeux = $stmt->fetchAll();
                return $jeux;
            } catch (PDOException $e) {
                echo "Échec lors de la connexion à la base de données: " . $e->getMessage();
            }
        }

        public function getBestSellers()
        {
            try {
                $stmt = $this->connexion->prepare("SELECT * FROM jeux j
                                                INNER JOIN jeux_categories jc
                                                ON j.id_jeu = jc.id_jeu 
                                                ORDER BY fois_achete DESC, date_de_sortie");
                $stmt->execute();
                $jeux = $stmt->fetchAll();
                return $jeux;
            } catch (PDOException $e) {
                echo "Échec lors de la connexion à la base de données: " . $e->getMessage();
            }
        }

        //Get precommandes dans la liste de jeux
        public function getJeuxByPrecommandes()
        {
            try {
                $stmt = $this->connexion->prepare("SELECT * FROM jeux j
                                                INNER JOIN jeux_categories jc
                                                ON j.id_jeu = jc.id_jeu 
                                                where date_de_sortie > CURDATE()");
                $stmt->execute();
                $jeux = $stmt->fetchAll();
                return $jeux;
            } catch (PDOException $e) {
                echo "Échec lors de la connexion à la base de données: " . $e->getMessage();
            }
        }

        //Page d'accueil
        public function getJeuxRabais(): array
        {
            try {
                $request = "select j.id_jeu, nom, developpeur, editeur, rating, prix, rabais, date_de_sortie, image_lien, categorie
                        from jeux j
                        inner join jeux_categories c 
                        on j.id_jeu = c.id_jeu
                        where rabais > 0
                        order by rabais
                        limit 5;";
                $result = $this->connexion->query($request);
                $items = $result->fetchAll();
                return $items;
            } catch (PDOException $e) {
                return $e;
            }
        }

        //Page d'accueil
        public function getJeuxMeilleuresVentes(): array
        {
            try {
                $request = "SELECT * FROM jeux j
                            INNER JOIN jeux_categories jc
                            ON j.id_jeu = jc.id_jeu 
                            ORDER BY fois_achete DESC, rabais DESC
                            LIMIT 3;";
                $result = $this->connexion->query($request);
                $items = $result->fetchAll();
                return $items;
            } catch (PDOException $e) {
                return $e;
            }
        }

        //Page d'accueil
        public function getJeuxDernieresNouveautees(): array
        {
            try {
                $request = "select j.id_jeu, nom, developpeur, editeur, rating, prix, rabais, date_de_sortie, image_lien, categorie
                        from jeux j
                        inner join jeux_categories c 
                        on j.id_jeu = c.id_jeu
                        order by date_de_sortie DESC,rabais
                        limit 3;";
                $result = $this->connexion->query($request);
                $items = $result->fetchAll();
                return $items;
            } catch (PDOException $e) {
                return $e;
            }
        }

        //Get Precommandes dans la page d'accueil
        public function getJeuxPrecommande(): array
        {
            try {
                $request = "select j.id_jeu, nom, developpeur, editeur, rating, prix, rabais, date_de_sortie, image_lien, categorie
                        from jeux j
                        inner join jeux_categories c 
                        on j.id_jeu = c.id_jeu
                        where date_de_sortie > now()
                        order by date_de_sortie,rabais
                        limit 3;";
                $result = $this->connexion->query($request);
                $items = $result->fetchAll();
                return $items;
            } catch (PDOException $e) {
                return $e;
            }
        }
    }


    