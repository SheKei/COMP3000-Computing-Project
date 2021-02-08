<?php
include_once '../Model/Database.php';
include_once '../Model/Module_Class.php';
include_once '../Model/Module_Assignment.php';
include_once '../Controller/taskController.php';

class Class_Controller
{
    private $user;
    private $database;
    private $controller;

    /**
     * Class_Controller constructor.
     * @param $user
     * @param $database
     */
    public function __construct($user)
    {
        $this->user = $user;
        $this->database = new Database();
        $this->controller = new Task_Controller($user);
    }

    //Add a class to timetable
    public function addClass($module, $name, $room, $day, $time, $duration){
        $this->database->addClass($this->user, $module, $name, $room, $day, $time, $duration);
    }

    //Save edit details of class
    public function editClass($classId,$moduleCode, $className, $classRoom, $classDay, $startTime, $classDuration){
        $this->database->editClass($classId, $moduleCode, $className, $classRoom, $classDay, $startTime, $classDuration);
    }

    //Delete a class
    public function deleteClass($classId){
        $this->database->deleteClass($classId);
    }

    //Update attendance on a class
    public function updateAttendance($classId){
        $this->database->updateAttendance($this->user, $classId);
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

    //Display today's classes on home page
    public function showTodaysClasses(){
        $result = $this->database->getTodaysClasses($this->user);
        if($result){
            echo "<section><h1>Today's Classes</h1>";
            foreach($result as $row){
                echo '<p>'.$row['module_code'].' '.$row['module_name'].' - '.
                    '<button class="btn viewClassBtn" data-toggle="modal" data-target="#viewClass" 
                    id="'.$row['class_id'].'">'.$row['class_name'].'</button> - '.$row['start_time'].
                    '<button class="btn logAttendance" id="'.$row['class_id'].'">Log Attendance</button></p>';
            }
            echo '</section>';
        }
    }

    public function getClassDetails($classId){
        $result = $this->database->getClass($classId);
        if($result){
            echo '<form method="post" action="../Controller/classController.php">';
            foreach($result as $row){
                //CLASS ID - HIDDEN
                echo '<input class="form-control hidden"  name="idClass" value="'.$row['class_id'].'" readonly>';

                //MODULE ASSIGNED TO
                echo '<label for="moduleAssigned">Module:</label>
                <select class="form-control" id="moduleAssigned" name="moduleAssigned">';
                echo "<option value='" . $row['module_code'] . "'>" . $row['module_code'] . " - " . $row['module_name'] . "</option>";
                $this->controller->displayModuleChoices();
                echo '</select>';

                //CLASS NAME
                echo '<label for="theClassName">Class Name:</label><input type="text" class="form-control" name="theClassName" id="theClassName" value="'.$row['class_name'].'">';

                //CLASS ROOM
                echo '<label for="room">Location</label><input type="text" class="form-control" name="room" id="room" value="'.$row['class_room'].'">';

                //CLASS DAY
                $weekday = $this->returnDayOfWeek($row['class_day']);
                echo '<label for="day">Day:</label>';
                echo '<select class="form-control" id="day" name="day">
                <option value="'.$row['class_day'].'">'.$weekday.'</option>';
                $this->outputDayDropDownMenu();
                echo '</select>';


                //START TIME
                echo '<label for="time">Start Time:</label><input type="time" class="form-control" name="time" id="name" value="'.$row['start_time'].'">';

                //CLASS DURATION
                echo '<label for="duration">Class Duration:</label><input type="text" id="duration" class="form-control" name="duration" value="'.$row['class_duration'].'">';
            }
            //SUBMIT BTN
            echo '<button class="btn btn-default" type="submit" name="editClassBtn" id="editClassBtn">Save Edit</button></form>';

            //DELETE BTN
            echo '<button class="btn btn-danger classDeleteBtn" type="button" id="'.$row['class_id'].'">Delete Class</button>';
            $this->echoJquery();
        }
    }

    public function echoJquery(){
        echo '
        <script>
            $(function(){
                $(".classDeleteBtn").click(function(){
                   let classId = this.id;
                   window.location.href = "../Controller/classController.php?deleteClassId="+classId;
                });
            });
        </script>
        ';
    }

    public function returnDayOfWeek($num){
        switch ($num){
            case 0:
                return "Monday";
            case 1:
                return "Tuesday";
            case 2:
                return "Wednesday";
            case 3:
                return "Thursday";
            case 4:
                return "Friday";
        }
    }

    public function outputDayDropDownMenu()
    {
        echo '
        <option value="0">Monday</option>
        <option value="1">Tuesday</option>
        <option value="2">Wednesday</option>
        <option value="3">Thursday</option>
        <option value="4">Friday</option>
        ';
    }


}