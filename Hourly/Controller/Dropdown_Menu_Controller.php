<?php
include_once '../Model/Database.php';

class Dropdown_Menu_Controller
{
    protected $user;
    protected $database;

    /**
     * Dropdown_Menu_Controller constructor
     */
    public function __construct($user)
    {
        $this->user = $user;
        $this->database = new Database();
    }

    //Display menu with all modules that have at least one ongoing task assigned to them
    public function displayModuleDropDown(){
        $modules = $this->database->getAllModulesWithTasks($this->user);
        $once = 0; $first ="";
        if($modules){
            foreach ($modules as $row){
                if($once === 0){
                    $first = $row['module_code'];
                    $once++;
                }
                echo "<option value='" . $row['module_code'] . "'>" . $row['module_code'] . " - " . $row['module_name'] . "</option>";

            }
        }
        return $first;
    }

    //Display menu with all tasks assigned to chosen module
    public function displayModuleTasks($moduleCode){
        $modules = $this->database->getAllModuleTasks($this->user, $moduleCode);
        if($modules){
            foreach ($modules as $row){
                echo "$('#taskChoice').append('<option value='" . $row['task_id'] . "'>" . $row['task_name'] . " - " . $row['module_code'] . "</option>')";
            }
        }
    }
}