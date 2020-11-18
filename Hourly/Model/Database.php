<?php


class Database
{
    private $username = 'COMP3000_STong';
    private $password = 'SmjU850*';
    private $database = 'COMP3000_STong';
    private $db_server = 'proj-mysql.uopnet.plymouth.ac.uk';
    private $dataSourceName;
    private $connection;
    private $procedure = "CALL COMP3000_STong.";

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
        $sql = $this->procedure."add_module('".$user."','".$module_code."','".$module_name."','".$colour_key."',".$expected_hours.")";
        $this->executeStatementNoOutput($sql);
    }

    //Assign a task to a module
    public function assignTask($module_code, $user, $task_name, $task_category, $due_date, $due_time, $priority_level)
    {
        $sql = $this->procedure."add_task('".$user."','".$module_code."','".$task_name."','".$task_category."','".$due_date."','".$due_time."','".$priority_level."')";
        $this->executeStatementNoOutput($sql);
    }

    //Return all modules user has made
    public function getModuleCodes($user){
        $sql = $this->procedure."get_modules('".$user."')";
        return $this->executeStatement($sql);
    }

    //Return all details for one module
    public function getModuleDetails($user, $module_code){
        $sql = $this->procedure."view_module('".$user."','".$module_code."')";
        return $this->executeStatement($sql);
    }

    //Edit Module
    public function editModuleDetails($user, $moduleCode, $moduleName, $colour, $expectedHours, $currentCode){
        $sql = $this->procedure."edit_module('".$user."','".$moduleCode."','".$moduleName."','".$colour."',".$expectedHours.",'".$currentCode."')";
        $this->executeStatementNoOutput($sql);
    }

    //Get all ongoing tasks user has made
    public function getAllOngoingTasks($user){
        $sql = $this->procedure."get_tasks('".$user."')";
        return $this->executeStatement($sql);
    }

    //Insert time for a task
    public function addTime($taskId, $theDuration, $theDescription, $theTimeStamp){
        $sql = $this->procedure."add_time(".$taskId.",'".$theDuration."','".$theDescription."','".$theTimeStamp."')";
        $this->executeStatementNoOutput($sql);
    }

    //Get all ongoing tasks for one module
    public function getModuleOngoingTasks($user, $module)
    {
        $sql = $this->procedure."get_ongoing_module_tasks('".$user."','".$module."')";
        return $this->executeStatement($sql);
    }

    //Mark an ongoing task as complete
    public function completeTask($user, $taskId)
    {
        $sql = $this->procedure."complete_task('".$user."',".$taskId.")";
        $this->executeStatementNoOutput($sql);
    }

    //View further details of an individual task
    public function getTaskDetails($taskId){
        $sql = $this->procedure."get_task_details('".$taskId."')";
        return $this->executeStatement($sql);
    }

    //Get time spent on a selected task
    public function getTaskTime($taskId){
        $sql = $this->procedure."get_task_time(".$taskId.")";
        return $this->executeStatement($sql);
    }

}