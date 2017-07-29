<?php

class database
{

    private $dbh = null;

    // Connects to a sqlite3 database

    function __construct($file)
    {
        $this->dbh = new \PDO("sqlite:$file");
    }

    public function executeQuery($query, $params = [])
    {
        $stmt = $this->dbh->prepare($query);

        try
        {
            $stmt->execute($params);
        }
        catch (PDOException $e)
        {
            return false;
        }

        return $stmt;

    }
}
