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

    public function getJeuxRecommandees(): array
    {
        $items = array();
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
        catch(PDOException $e) {
            return $items;
        }
    }
}