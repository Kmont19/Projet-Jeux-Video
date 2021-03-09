<?php
require_once (__DIR__.'/../Connexion.php');

class ModelCompte
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

    public function ajoutCompte(string $email, string $pseudo, string $motdepasse){
        try {
            $stmt = $this->connexion->prepare(
                "insert into utilisateurs values(:email, :pseudo, :motdepasse);");
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':pseudo', $pseudo);
            $stmt->bindParam(':motdepasse', $motdepasse);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            echo $e;
            return false;
        }
    }
}