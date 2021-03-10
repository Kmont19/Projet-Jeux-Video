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

    public function ajoutPanier(string $id_panier, string $email_client){
        try {
            $stmt = $this->connexion->prepare(
                "INSERT INTO paniers values(:id_panier, :email_client);");
            $stmt->bindParam(':id_panier', $id_panier);
            $stmt->bindParam(':email_client', $email_client);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            return false;
        }
    }

    public function ajoutJeuPanier(string $id_panier, string $id_jeu){
        try {
            $stmt = $this->connexion->prepare(
                "INSERT INTO paniers_jeux values(:id_panier, :id_jeu);");
            $stmt->bindParam(':id_panier', $id_panier);
            $stmt->bindParam(':id_jeu', $id_jeu);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            return false;
        }
    }

    public function ajoutFacture(string $id_facture, string $email_client){
        try {
            $stmt = $this->connexion->prepare(
                "INSERT INTO factures values(:id_facture, :email_client);");
            $stmt->bindParam(':id_facture', $id_facture);
            $stmt->bindParam(':email_client', $email_client);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            return false;
        }
    }

    public function ajoutJeuDansFacture(string $id_facture, string $id_jeu){
        try {
            $stmt = $this->connexion->prepare(
                "INSERT INTO factures_jeux values(:id_facture, :id_jeu);");
            $stmt->bindParam(':id_facture', $id_facture);
            $stmt->bindParam(':id_jeu', $id_jeu);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            return false;
        }
    }
}