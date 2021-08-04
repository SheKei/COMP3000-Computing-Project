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

    //Return array of class objects BY MODULE
    public function getTimetableByModule(){
        return $this->getTimetable($this->database->getTimetable($this->user));
    }

    //Return array of class objects by DAY
    public function getTimetableByDay(){
        return $this->getTimetable($this->database->getTimetableByDays($this->user));
    }

    //Return array of timetabled class objects
    public function getTimetable($result){
        $classes = [];
        if($result){
            foreach($result as $row){
                $class = new Module_Class($row['module_code'], $row['module_name'], $row['class_id'], $row['class_name'], $row['class_room'], $this->returnDayOfWeek($row['class_day']), $row['start_time'], $row['class_duration'], $row['last_attendance'], $row['times_attended']);
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
                $module = new Module($row['module_code'], $row['module_name'], 0, $row['colour_key']);
                $modules[] = $module;
            }
        }
        return $modules;
    }

    //Display section titles by module names
    public function displayModuleSections(){
        $modules = $this->getModules();
        if($modules){
            foreach($modules as $module){
                $colour = $module->getColour(); //If background is black, change font to white
                if($colour == "rgb(51, 57, 64)"){
                    $style = "background-color:".$colour.";color:white";
                }else{$style = "background-color:".$colour;}

                echo '<h1 style="'.$style.'" class="moduleTitle" id="'.$module->getModuleCode().'">'.$module->getModuleCode().' - '.$module->getModuleName().'</h1>';
                echo '<hr class="my-4">';
            }
        }
    }

    //Sort timetable classes BY MODULE
    public function sortTimetableClasses(){
        $classes = $this->getTimetableByModule();
        if($classes){ //Button to bring pop-up page for class details
            foreach($classes as $class){
                echo '$("#'.$class->getModuleCode().'").append("<p class=\"classes classNames\">'.$class->getClassDay()." - ".date("H:i",strtotime($class->getStartTime())).
                    ' - <button data-toggle=\"modal\" data-target=\"#viewClass\" class=\"btn viewClassBtn\" id=\"'.$class->getClassId().'\">'
                    .$class->getClassName().'</p></p>");';
            }
        }
    }

    //Sort timetable BY DAY
    public function sortTimeTableByDay(){
        $classes = $this->getTimetableByDay();
        if($classes){
            foreach($classes as $class){
                echo '$("#'.$class->getClassDay().'").append("<p class=\"classes classNames\">'.date("H:i",strtotime($class->getStartTime()))
                    ." - ".$class->getModuleCode().
                    ' - <button data-toggle=\"modal\" data-target=\"#viewClass\" class=\"btn viewClassBtn\" id=\"'.$class->getClassId().'\">'
                    .$class->getClassName().'</p></p>");';
            }
        }
    }

    //Display today's classes on home page
    public function showTodaysClasses(){
        $result = $this->database->getTodaysClasses($this->user);
        if($result){
            echo "<section><h1 class='title' id='classTitle'>Today's Classes</h1>";
            foreach($result as $row){
                echo '<p>'.$row['module_code'].' '.$row['module_name'].' - '.
                    '<button class="btn viewClassBtn" data-toggle="modal" data-target="#viewClass" 
                    id="'.$row['class_id'].'">'.$row['class_name'].'</button> - '.$row['start_time'].
                    '<button class="btn btn-dark logAttendance" id="'.$row['class_id'].'">Log Attendance</button></p>';
            }
            echo '</section>';
        }
    }

    public function getClassDetails($classId){
        $result = $this->database->getClass($classId);
        if($result){

            echo '<form method="post" action="../Controller/classController.php">';
            foreach($result as $row){
                echo "<h4 class='text-center'>Times Attended: ".$row['times_attended']."</h4>";
                echo "<h4 class='text-center'>Last Attendance: ".date("d/m/Y", strtotime($row['last_attendance']))."</h4><br>";
                //CLASS ID - HIDDEN
                echo '<input class="form-control hidden"  name="idClass" value="'.$row['class_id'].'" readonly>';

                //MODULE ASSIGNED TO
                echo '<div class="form-group row"><div class="col-3"><label for="moduleAssigned">Module:</label></div>';
                echo '<div class="col-6"><select class="form-control" id="moduleAssigned" name="moduleAssigned">';
                echo "<option value='" . $row['module_code'] . "'>" . $row['module_code'] . " - " . $row['module_name'] . "</option>";
                $this->controller->displayModuleChoices();
                echo '</select></div></div>';

                //CLASS NAME
                echo '<div class="form-group row"><div class="col-3"><label for="theClassName">Class Name:</label></div>';
                echo '<div class="col-6"><input type="text" class="form-control" name="theClassName" id="theClassName" value="'.$row['class_name'].'"></div></div>';

                //CLASS LOCATION
                echo '<div class="form-group row"><div class="col-3"><label for="room">Location:</label></div>';
                echo '<div class="col-6"><input type="text" class="form-control" name="room" id="room" value="'.$row['class_room'].'"></div></div>';

                //CLASS DAY
                $weekday = $this->returnDayOfWeek($row['class_day']);
                echo '<div class="form-group row"><div class="col-3"><label for="day">Day:</label></div>';
                echo '<div class="col-6"><select class="form-control" id="day" name="day"><option value="'.$row['class_day'].'">'.$weekday.'</option>';
                echo '<option value="'.$row['class_day'].'">'.$weekday.'</option>';
                $this->outputDayDropDownMenu();
                echo '</select></div></div>';

                //START TIME
                echo '<div class="form-group row"><div class="col-3"><label for="time">Start Time:</label></div>';
                echo '<div class="col-6"><input type="time" class="form-control" name="time" id="name" value="'.$row['start_time'].'"></div></div>';

                //CLASS DURATION
                echo '<div class="form-group row"><div class="col-3"><label for="duration">Class Duration:</label></div>';
                echo '<div class="col-2"><input type="number" name="theHour" class="form-control"
                      min="0" max="23" value="'.date('H', strtotime($row['class_duration'])).'" required></div>';
                echo '<div class="col-2"><label> hour(s)</label></div>';
                echo '<div class="col-2"><input type="number" name="theMinutes" class="form-control"
                      min="0" max="59" value="'.date('i', strtotime($row['class_duration'])).'" required></div>';
                echo '<div class="col-1"><label> minutes</label></div></div>';
            }
            //SUBMIT BTN
            echo '<button class="btn btn-success float-left" type="submit" name="editClassBtn" id="editClassBtn">Save Edit</button></form>';

            //DELETE BTN
            echo '<button class="btn btn-danger float-right classDeleteBtn" type="button" id="'.$row['class_id'].'">Delete Class</button>';
            $this->echoJquery();
        }
    }

    //JQUERY SCRIPT to delete a class when btn clicked
    public function echoJquery(){
        echo '
        <script>
            $(function(){
                $(".classDeleteBtn").click(function(){
                   let classId = this.id;   //Find the ID of which class was selected
                   window.location.href = "../Controller/classController.php?deleteClassId="+classId;
                });
            });
        </script>
        ';
    }

    public function returnDayOfWeek($num){
        switch ($num){
            case 0:
                return "Mon";
            case 1:
                return "Tues";
            case 2:
                return "Wed";
            case 3:
                return "Thurs";
            case 4:
                return "Fri";
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