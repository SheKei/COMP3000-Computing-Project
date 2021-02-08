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

    //Delete Module
    public function deleteModule($user, $moduleCode){
        $sql = $this->procedure."delete_module('".$user."','".$moduleCode."')";
        $this->executeStatementNoOutput($sql);
    }

    //Assign a task to a module
    public function assignTask($module_code, $user, $task_name, $task_category, $due_date, $due_time, $priority_level)
    {
        $sql = $this->procedure."add_task('".$user."','".$module_code."','".$task_name."','".$task_category."','".$due_date."','".$due_time."','".$priority_level."')";
        $this->executeStatementNoOutput($sql);
    }

    //Edit ongoing task details
    public function editTask($taskId, $moduleCode, $taskName, $taskCategory, $dueDate, $dueTime, $priorityLevel){
        $sql = $this->procedure."edit_task('".$taskId."','".$moduleCode."','".$taskName."','".$taskCategory."','".$dueDate."','".$dueTime."','".$priorityLevel."')";
        $this->executeStatementNoOutput($sql);
    }

    //Get all ongoing tasks user has made for all modules
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
        $sql = $this->procedure."get_module_tasks('".$user."','".$module."','Ongoing')";
        return $this->executeStatement($sql);
    }

    //Get all completed tasks for one module
    public function getModuleCompletedTasks($user, $module){
        $sql = $this->procedure."get_module_tasks('".$user."','".$module."', 'Complete')";
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

    //Delete a time spent on a task
    public function deleteTime($timeId){
        $sql = $this->procedure."delete_task_time(".$timeId.")";
        $this->executeStatementNoOutput($sql);
    }

    //Delete a task and time spent on it
    public function deleteTask($taskId){
        $sql = $this->procedure."delete_task(".$taskId.")";
        $this->executeStatementNoOutput($this->procedure."delete_task(".$taskId.")");
    }

    //Add class to timetable
    public function addClass($user, $module, $className, $classRoom, $classDay, $startTime, $classDuration){
        $sql = $this->procedure."add_class('".$user."','".$module."','".$className."','".$classRoom."','".$classDay."','".$startTime."','".$classDuration."')";
        $this->executeStatementNoOutput($sql);
    }

    //Get all timetabled classes
    public function getTimetable($user){
        $sql = $this->procedure."get_all_classes('".$user."')";
        return $this->executeStatement($sql);
    }

    //Get details for a class
    public function getClass($classId){
        $sql = $this->procedure."get_class(".$classId.")";
        return $this->executeStatement($sql);
    }

    //Get today's classes
    public function getTodaysClasses($userId){
        $sql = $this->procedure."get_upcoming_class('".$userId."')";
        return $this->executeStatement($sql);
    }

    //Update class
    public function editClass($classId, $moduleCode, $className, $classRoom, $classDay, $startTime, $classDuration){
        $sql = $this->procedure."edit_class(".$classId.",'".$moduleCode."','".$className."','".$classRoom."','".$classDay."','".$startTime."','".$classDuration."')";
        $this->executeStatementNoOutput($sql);
    }

    //Delete class
    public function deleteClass($classId){
        $sql = $this->procedure."delete_class(".$classId.")";
        $this->executeStatementNoOutput($sql);
    }

    //Update class attendance
    public function updateAttendance($username, $classId){
        $sql = $this->procedure."update_attendance('".$username."',".$classId.")";
        $this->executeStatementNoOutput($sql);
    }

    //Get account details
    public function getAccountDetails($username){
        $sql = $this->procedure."get_account('".$username."')";
        return $this->executeStatement($sql);
    }

    //Update email and date of birth
    public function updateAccount($username, $email, $birthdate){
        $sql = $this->procedure."update_account('".$username."','".$email."','".$birthdate."')";
        $this->executeStatementNoOutput($sql);
    }

    //Create new account
    public function createAccount($username, $password, $email, $birthdate){
        $sql = $this->procedure."create_account('".$username."','".$password."','".$email."','".$birthdate."')";
        $this->executeStatementNoOutput($sql);
    }
}