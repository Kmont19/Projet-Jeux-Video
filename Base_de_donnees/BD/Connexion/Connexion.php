<?php

class Connexion
{
    private $connexion;
    public function __construct()
    {
        try {
            $this->connexion = new PDO(
                "mysql:host=localhost;dbname=h2021_420617ri_gr01_equipe_1;port=3306,charset=utf8",
                "1647207",
                "1647207");
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
