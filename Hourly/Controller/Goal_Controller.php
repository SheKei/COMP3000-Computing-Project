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
        $onTasks = $this->database->weeklyOverallModuleHours($this->user);
        $onClass = $this->database->weeklyOverallClassHours($this->user);
        $totalDuration = date("H:i",strtotime($onTasks)+strtotime($onClass));
        return $totalDuration;
    }

    //Calculate the number of hours spent so far today
    public function getTodaysHours(){
        $onTasks = $this->database->todayModuleHours($this->user);
        $onClass = $this->database->todayClassHours($this->user);
        $totalDuration = date("H:i",strtotime($onTasks)+strtotime($onClass));
        return $totalDuration;
    }

    //Calculate the TOTAL number of hours spent so far on a module
    public function getTotalHoursOnModule($moduleCode){
        $onTasks = $this->database->overallModuleTaskHours($moduleCode,$this->user);
        $onClass = $this->database->overallModuleClassHours($moduleCode,$this->user);
        $totalDuration = date("H:i",strtotime($onTasks)+strtotime($onClass));
        return $totalDuration;
    }

    //Calculate the number of hours spent on a module so far this WEEK
    public function getWeeklyHoursOnModule($moduleCode){
        $onTasks = $this->database->weeklyModuleTaskHours($moduleCode,$this->user);
        $onClass = $this->database->weeklyModuleClassHours($moduleCode,$this->user);
        $totalDuration = date("H:i",strtotime($onTasks)+strtotime($onClass));
        return $totalDuration;
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
        echo "<p>This Week: ".$weeklyHours. "hours</p>";
    }

}