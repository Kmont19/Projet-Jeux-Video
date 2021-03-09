<?php
require_once (__DIR__.'/../Connexion.php');

class ModelPanier
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

    public function viderPanier(string $id_panier){
        try {
            $stmt = $this->connexion->prepare(
                "Delete from paniers_jeux where id_panier=:id_panier");
            $stmt->bindParam(':id_panier', $id_panier);
            $stmt->execute();
            $stmt = $this->connexion->prepare(
                "Delete from paniers where id_panier=:id_panier");
            $stmt->bindParam(':id_panier', $id_panier);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            echo $e;
            return false;
        }
    }

    public function supprimerJeuPanier(string $id_panier, string $id_jeu){
        try {
            $stmt = $this->connexion->prepare(
                "Delete from paniers_jeux where id_panier=:id_panier AND id_jeu=:id_jeu");
            $stmt->bindParam(':id_panier', $id_panier);
            $stmt->bindParam(':id_jeu', $id_jeu);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            echo $e;
            return false;
        }
    }
}