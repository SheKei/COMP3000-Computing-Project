<?php
include_once "../Model/Database.php";
include_once '../Model/Module.php';

class Module_Controller
{
    private $database;
    private $username;
    /**
     * Module_Controller constructor.
     */
    public function __construct($user)
    {
        $this->database = new Database();
        $this->username = $user;
    }

    //Create a module using user's inputs
    public function createModule($moduleCode, $moduleName, $colour, $expectedHours){
        $this->database->addModule($this->username,$moduleCode, $moduleName, $colour, $expectedHours);
    }

    //Display modules as navigation items
    public function displaySideBar()
    {
        $modules = $this->database->getModuleCodes($this->username);
        //<a href="#" class="w3-bar-item w3-button">Link 1</a>
        if($modules){
            foreach($modules as $row){
                $code = $row['module_code'];
                echo $link = '<a href="module.php?code='.$code.'" class="w3-bar-item w3-button">'.$row['module_code'].'-'.$row['module_name'].'</a>';
            }
        }
        echo '<a href="timetable.php" class="w3-bar-item w3-button">Timetable</a>';
    }

    //Return with all details of selected module
    public function displayModulePage($moduleCode)
    {
        $module ="";
        $result = $this->database->getModuleDetails($this->username, $moduleCode);
        if(isset($result))
        {
            foreach($result as $row){
                $code = $row['module_code'];
                $name = $row['module_name'];
                $hours = $row['expected_hours'];
                $colour = $row['colour_key'];

                $this->displayPageHeading($code, $name);
                $module = new Module($code, $name, $hours, $colour);
            }
        }
        return $module;
    }

    //Display module name and code as page heading
    public function displayPageHeading($moduleCode, $moduleName)
    {
        echo "<div id='heading' class='jumbotron jumbotron-fluid'>";
        echo "<h1 class='display-4'>".$moduleCode."</h1>";
        echo "<p class='lead'>".$moduleName."</p>";
        echo "<button class='btn' data-toggle='modal' data-target='#viewModule'>VIEW MODULE DETAILS</button>";
        echo "</div>";
    }

    //Update module details
    public function updateModuleDetails($module_code, $module_name, $colour_key, $expected_hours, $current_code){
        $this->database->editModuleDetails($this->username, $module_code, $module_name, $colour_key, $expected_hours, $current_code);
    }

    //Delete module and all tasks
    public function deleteModule($moduleCode){
        $this->database->deleteModule($this->username, $moduleCode);
    }
}