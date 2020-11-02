<?php


class Database
{
    private $username = 'COMP3000_STong';
    private $password = 'SmjU850';
    private $database = 'COMP3000_STong';
    private $db_server = 'proj-mysql.uopnet.plymouth.ac.uk';
    private $dataSourceName;
    private $connection;

    public function __construct(PDO $connection = null)
    {
        $this->connection = $connection;
        try {
            if ($this->connection === null) {
                $this->dataSourceName = 'mysql:dbname=' . $this->database . ';host=' . $this->db_server;
                $this->connection = new PDO($this->dataSourceName, $this->username, $this->password);
                $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            }
        }catch (PDOException $err)
        {
            echo 'Connection failed: ', $err->getMessage();
        }
    }

    //Execute procedures with SELECT statements
    public function executeStatement($sqlStatement)
    {
        $sqlStatement = $this->connection->prepare($sqlStatement);
        $sqlStatement->execute();
        return $sqlStatement->fetchAll(PDO::FETCH_ASSOC);
    }

    //Execute procedures with INSERT/DELETE/UPDATE statements
    public function executeStatementNoOutput($sqlStatement)
    {
        $sqlStatement = $this->connection->prepare($sqlStatement);
        $sqlStatement->execute();
    }
}