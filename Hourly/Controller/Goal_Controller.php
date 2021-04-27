<?php
include_once '../Model/Database.php';

class Goal_Controller
{
    private $user;
    private $database;

    public function __construct($user)
    {
        $this->user = $user;
        $this->database = new Database();
    }

    //Calculate the overall number of hours spent for current week
    public function getOverallWeeklyHours(){
        $onTasks = explode(":", $this->database->weeklyOverallModuleHours($this->user));
        $onClass = explode(":", $this->database->weeklyOverallClassHours($this->user));
        return $this->addTime($onTasks[1], $onClass[1],$onTasks[0]+$onClass[0]);
    }

    //Calculate the number of hours spent so far today
    public function getTodaysHours(){
        $onTasks = explode(":", $this->database->todayModuleHours($this->user));
        $onClass = explode(":", $this->database->todayClassHours($this->user));
        return $this->addTime($onTasks[1], $onClass[1],$onTasks[0]+$onClass[0]);
    }

    //Calculate the TOTAL number of hours spent so far on a module
    public function getTotalHoursOnModule($moduleCode){
        $onTasks = explode(":", $this->database->overallModuleTaskHours($moduleCode,$this->user));
        $onClass = explode(":", $this->database->overallModuleClassHours($moduleCode,$this->user));
        return $this->addTime($onTasks[1], $onClass[1],$onTasks[0]+$onClass[0]);
    }

    //Calculate the number of hours spent on a module so far this WEEK
    public function getWeeklyHoursOnModule($moduleCode){
        $onTasks = explode(":", $this->database->weeklyModuleTaskHours($moduleCode,$this->user));
        $onClass = explode(":", $this->database->weeklyModuleClassHours($moduleCode,$this->user));

        return $this->addTime($onTasks[1], $onClass[1],$onTasks[0]+$onClass[0]);
    }

    //Add up the durations into HOUR:MINUTES
    public function addTime($minutes1, $minutes2, $totalHours){
        $totalHours = ($totalHours)+(int)(($minutes1 + $minutes2)/60);          //Add up the hours first
        $minutes = ($minutes1 + $minutes2)%60;                                  //Find the leftover minutes
        return $totalHours.":".$minutes;
    }

    //Update the goal for daily hours spent working
    public function updateDailyGoal($newGoal){
        $this->database->updateDailyGoal($this->user, $newGoal);
    }

    //Update the goal for hours spent in a week
    public function updateWeeklyGoal($newGoal){
        $this->database->updateWeeklyGoal($this->user, $newGoal);
    }


    public function displayOverallHours(){
        $thisWeek = $this->getOverallWeeklyHours();
        $today = $this->getTodaysHours();

        echo "<p>This Week: ".$thisWeek." hours</p>";
        echo "<p>Today: ".$today." hours</p>";
    }

    public function displayModuleHours($moduleCode){
        $totalHours = $this->getTotalHoursOnModule($moduleCode);
        $weeklyHours = $this->getWeeklyHoursOnModule($moduleCode);

        echo "<p>Overall: ".$totalHours." hours</p>";
        echo "<p>This Week: ".$weeklyHours. " hours</p>";
    }

}