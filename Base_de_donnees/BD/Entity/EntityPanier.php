<?php
require_once (__DIR__.'/../Connexion.php');

class EntityPanier
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

    public function getPanierComplet(string $email){
        try {
            $stmt = $this->connexion->prepare("select p.email_client as email_client, pj.id_panier as id_panier, j.id_jeu as id_jeu, j.nom as nom, j.developpeur as developpeur, j.editeur as editeur, j.prix as prix, j.rabais as rabais, j.image_lien as image_lien
                                                     from paniers p
                                                     inner join paniers_jeux pj on p.id_panier = pj.id_panier
                                                     inner join jeux j on pj.id_jeu = j.id_jeu
                                                     where p.email_client='$email';");
            $stmt->execute();
            $jeux = $stmt->fetchAll();
            return $jeux;
        } catch (PDOException $e) {
            echo "Échec lors de la connexion à la base de données: " . $e->getMessage();
        }
    }

}