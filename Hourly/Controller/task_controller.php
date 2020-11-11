<?php
include_once '../Model/Database.php';

class task_controller
{
    private $database;
    private $username;

    /**
     * task_controller constructor.
     */
    public function __construct($user)
    {
        $this->username = $user;
        $this->database = new Database();
    }

    public function displayModuleChoices()
    {
        //Get all modules user has made
        $modules = $this->database->getModuleCodes($this->username);

        if($modules){
            foreach($modules as $row)
            {
                echo "<option value='".$row['module_code']."'>".$row['module_code']." - ".$row['module_name']."</option>";
            }
        }
    }

    //Create a task and assign to a module
    public function assignTask($moduleCode, $taskName, $taskCategory, $dueDate, $dueTime, $priorityLevel)
    {
        $this->database->assignTask($moduleCode, $this->username, $taskName, $taskCategory, $dueDate, $dueTime, $priorityLevel);
    }

    //Display all ongoing tasks in a drop down menu for add time pop up page
    public function displayOngoingTasks()
    {
        $tasks = $this->database->getAllOngoingTasks($this->username);

        if($tasks){
            foreach($tasks as $row){
                echo "<option value='".$row['task_id']."'>".$row['task_name']."(".$row['module_code'].")"."</option>";
            }
        }
    }


}