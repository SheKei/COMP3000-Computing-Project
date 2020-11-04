<?php


class Database
{
    private $username = 'COMP3000_STong';
    private $password = 'SmjU850*';
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

    //Create a module
    public function addModule($user, $module_code, $module_name, $colour_key, $expected_hours)
    {
        $sql = "CALL COMP3000_STong.add_module('".$user."','".$module_code."','".$module_name."','".$colour_key."',".$expected_hours.")";
        $this->executeStatementNoOutput($sql);
    }

    //Assign a task to a module
    public function assignTask($module_code, $user, $task_name, $task_category, $due_date, $due_time, $priority_level)
    {
        $sql = "CALL COMP3000_STong.add_task('".$module_code."','".$user."','".$task_name."','".$task_category."','".$due_date."','".$due_time."','".$priority_level."')";
        $this->executeStatementNoOutput($sql);
    }

    //Return all modules user has made
    public function getModuleCodes($user){
        
    }
}