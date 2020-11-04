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

    public function assignTask($moduleCode, $taskName, $taskCategory, $dueDate, $dueTime, $priorityLevel)
    {
        $this->database->assignTask($moduleCode, $this->username, $taskName, $taskCategory, $dueDate, $dueTime, $priorityLevel);
    }


}