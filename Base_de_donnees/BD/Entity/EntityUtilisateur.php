<?php
require_once(__DIR__ . '/../Connexion.php');

class EntityUtilisateur
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

    public function verifUtilisateur(string $email, string $motdepasse){
        try {
            $stmt = $this->connexion->prepare("select count(email) as nbrMail
                                                     from utilisateurs
                                                     where email = '$email'
                                                     and 
                                                     motdepasse = '$motdepasse';");
            $stmt->execute();
            $utilisateur = $stmt->fetchAll();
            return $utilisateur;
        } catch (PDOException $e) {
            echo "Échec lors de la connexion à la base de données: " . $e->getMessage();
        }
    }

}