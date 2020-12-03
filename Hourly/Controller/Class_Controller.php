<?php
include_once '../Model/Database.php';
include_once '../Model/Module_Class.php';
include_once '../Model/Module_Assignment.php';

class Class_Controller
{
    private $user;
    private $database;

    /**
     * Class_Controller constructor.
     * @param $user
     * @param $database
     */
    public function __construct($user)
    {
        $this->user = $user;
        $this->database = new Database();
    }

    //Add a class to timetable
    public function addClass($module, $name, $room, $day, $time, $duration){
        $this->database->addClass($this->user, $module, $name, $room, $day, $time, $duration);
    }

    //Return array of timetabled classes
    public function getTimetable(){
        $result = $this->database->getTimetable($this->user);
        $classes = [];
        if($result){
            foreach($result as $row){
                $class = new Module_Class($row['module_code'], $row['module_name'], $row['class_id'], $row['class_name'], $row['class_room'], $row['class_day'], $row['start_time'], $row['class_duration']);
                $classes[] = $class;
            }
        }
        return $classes;
    }

    //Get all modules to sort classes into
    public function getModules(){
        //Get all modules user has made
        $result = $this->database->getModuleCodes($this->user);
        $modules = [];
        if ($result) {
            foreach ($result as $row) {
                $module = new Module_Assignment($row['module_code'], $row['module_name']);
                $modules[] = $module;
            }
        }
        return $modules;
    }

    public function displayModuleSections(){
        $modules = $this->getModules();
        if($modules){
            foreach($modules as $module){
                echo '<h1 id="'.$module->getModuleCode().'">'.$module->getModuleCode().' - '.$module->getModuleName().'</h1>';
                echo '<hr class="my-4">';
            }
        }
    }

    public function sortTimetableClasses(){
        $classes = $this->getTimetable();
        if($classes){ //Button to bring pop-up page for class details
            foreach($classes as $class){
                echo '$("#'.$class->getModuleCode().'").append("<p class=\"classes\">'.$class->getStartTime().
                    ' - <button data-toggle=\"modal\" data-target=\"#viewClass\" class=\"btn viewClassBtn\" id=\"'.$class->getClassId().'\">'
                    .$class->getClassName().'</p></p>");';
            }
        }
    }

    public function getClassDetails($classId){
        $result = $this->database->getClass($classId);
        if($result){
            echo '<form>';
            foreach($result as $row){
                echo '<label for="className">Class Name:</label><input class="form-control" id="theClassName" value="'.$row['class_name'].'">';


            }
            echo '</form>';
        }
    }



}