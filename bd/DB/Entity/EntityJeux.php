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
        $classe = new;
        $this->connexion = $classe->g;
    }

    /**
     * Fetch all activities
     *
     * @return array
     */
    public function getActivities(): array
    {
        $items = array();
        try {
            $request = "SELECT * FROM activities";
            $result = $this->connection->query($request);
            $items = $result->fetchAll();

            return $items;
        }
        catch(PDOException $e) {
            return $items;
        }
    }

    /**
     * get specified activity by id
     *
     * @param int $id
     * @return array
     */
    public function getActivityByID(int $id): array
    {
        $items = array();
        try {
            $request = "SELECT * FROM activities WHERE id = '$id'";
            $result = $this->connection->query($request);
            $items = $result->fetch();

            return $items;
        }
        catch(PDOException $e) {
            return $items;
        }
    }
}