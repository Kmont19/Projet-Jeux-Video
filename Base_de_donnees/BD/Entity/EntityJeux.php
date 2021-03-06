<?php
require_once (__DIR__ . '/../Connexion.php');

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

    public function getJeux(): array
    {
        $items = array();
        try {
            $request = "select j.id_jeu, nom, developpeur, editeur, prix, rabais, date_de_sortie, image_lien, categorie
                        from jeux j
                        inner join jeux_categories c 
                        on j.id_jeu = c.id_jeu;";
            $result = $this->connexion->query($request);
            $items = $result->fetchAll();
            return $items;
        }
        catch(PDOException $e) {
            return $items;
        }
    }
}