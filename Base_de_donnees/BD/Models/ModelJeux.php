<?php
require_once ('../Connexion.php');

class ModelJeux
{
    private $connexion;

    /**
     * ModelJeux constructor.
     */
    public function __construct()
    {
        $class = new Connexion();
        $this->connexion = $class->getConnexion();
    }

    /**
     * @param string $id_jeu
     * @param string $nom
     * @param string $developpeur
     * @param string $editeur
     * @param string $rating
     * @param float $prix
     * @param float $rabais
     * @param string $date_de_sortie
     * @param string $image_lien
     * @return bool
     */
    public function ajoutJeu(string $id_jeu, string $nom, string $developpeur, string $editeur, string $rating, float $prix, float $rabais, string $date_de_sortie, string $image_lien): bool
    {
        try {
            $stmt = $this->connexion->prepare(
                "INSERT INTO jeux (id_jeu, nom, developpeur, editeur, rating, prix, rabais, date_de_sortie, image_lien) 
                                values(':id_jeu', ':nom', ':developpeur', ':editeur', ':rating', :prix, :rabais, ':date_de_sortie', ':image_lien')");
            $stmt->bindParam(':id_jeu', $id_jeu);
            $stmt->bindParam(':nom', $nom);
            $stmt->bindParam(':developpeur', $developpeur);
            $stmt->bindParam(':editeur', $editeur);
            $stmt->bindParam(':rating', $rating);
            $stmt->bindParam(':prix', $prix);
            $stmt->bindParam(':rabais', $rabais);
            $stmt->bindParam(':date_de_sortie', $date_de_sortie);
            $stmt->bindParam(':image_lien', $image_lien);
            $stmt->execute();
            echo true;
        } catch (PDOException $e) {
            echo $e;
            echo false;
        }
    }
}