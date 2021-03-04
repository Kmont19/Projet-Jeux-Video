<?php

class Connexion
{
    private $connexion;
    public function __construct()
    {
        try {
            $this->connexion = new PDO(
                "mysql:host=206.167.140.56;dbname=h2021_420617ri_gr01_equipe_1;port=3306,charset=utf8",
                "1842296",
                "1842296");
            $this->connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo $e;
        }
    }

    /**
     * @return PDO
     */
    public function getConnexion(): PDO
    {
        return $this->connexion;
    }
}
?>