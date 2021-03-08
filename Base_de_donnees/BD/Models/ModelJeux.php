<?php
require_once (__DIR__.'/../Connexion/Connexion.php');

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
     * @param file $image_lien
     * @return bool
     */
    public function ajoutJeu( $id_jeu,  $nom,  $categorie,  $developpeur,  $editeur,  $rating,  $prix,  $rabais, $date_de_sortie, $image_lien): bool
    {
        try {
            $imgPath = $this->storePath($image_lien);
            $stmtJeu = $this->connexion->prepare(
                "INSERT INTO jeux (id_jeu, nom, developpeur, editeur, rating, prix, rabais, date_de_sortie, image_lien) 
                                values(:id_jeu, :nom, :developpeur, :editeur, :rating, :prix, :rabais, :date_de_sortie, :image_lien)");
            $stmtJeu->bindParam(':id_jeu', $id_jeu);
            $stmtJeu->bindParam(':nom', $nom);
            $stmtJeu->bindParam(':developpeur', $developpeur);
            $stmtJeu->bindParam(':editeur', $editeur);
            $stmtJeu->bindParam(':rating', $rating);
            $stmtJeu->bindParam(':prix', $prix);
            $stmtJeu->bindParam(':rabais', $rabais);
            $stmtJeu->bindParam(':date_de_sortie', $date_de_sortie);
            $stmtJeu->bindParam(':image_lien', $imgPath);
            $stmtJeu->execute();

            $stmtCategorie = $this->connexion->prepare(
                "INSERT INTO jeux_categories (id_jeu, categorie) 
                                values(:id_jeu, :categorie)");
            $stmtCategorie->bindParam(':id_jeu', $id_jeu);
            $stmtCategorie->bindParam(':categorie', $categorie);
            $stmtCategorie->execute();

            return true;
        } catch (PDOException $e) {
            echo $e;
            return false;
        }
    }

    public function storePath($image){
        $filePath = "";
        $validExtensions =["gif", "jpg", "jpeg", "png"];
        $imgName = $image['name'];
        $dossier = '../ImagesAutos/';
        $chemin = $dossier . basename($imgName);
        $extension = strtolower(pathinfo($chemin, PATHINFO_EXTENSION));
        $imgTemp = $image['tmp_name'];
        if(isset($image)) {
            $reponse = 0;
            if(empty($image)) {
                $reponse = "Inserer une image";
            } else if (in_array($extension, $validExtensions)){
                $filePath = '../ImagesJeux/' . substr(md5(time()), 0, 10). '.'.$extension;
                move_uploaded_file($imgTemp, $filePath);
            } 
        }
        return $filePath;
    }

}
