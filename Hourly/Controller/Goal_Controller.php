<?php
include_once '../Model/Database.php';

class Goal_Controller
{
    private $user;
    private $database;
    private $weekly;
    private $daily;

    public function __construct($user)
    {
        $this->user = $user;
        $this->database = new Database();

        $result = $this->database->getGoals($this->user);
        foreach($result as $row){
            $this->weekly = $row['weekly_hours'];
            $this->daily = $row['daily_hours'];
        }
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

    //Display today and this week's hours spent on all modules
    public function displayOverallHours(){
        $thisWeek = $this->getOverallWeeklyHours();
        $today = $this->getTodaysHours();
        echo "<h4>Should be working for:<br> <strong>".$this->weekly."</strong> hours per week</h4>";
        echo "<h4>This Week Currently:<br> <strong>".$thisWeek."</strong> hours</h4>";
        echo "<h4>Should be working for<br> <strong>".$this->daily."</strong> hours per day</h4>";
        echo "<h4>Today You Have Worked for:<br> <strong>".$today."</strong> hours</h4>";
    }

    //Display total and this week's hours spent on selected module
    public function displayModuleHours($moduleCode){
        $totalHours = $this->getTotalHoursOnModule($moduleCode);
        $weeklyHours = $this->getWeeklyHoursOnModule($moduleCode);
        echo "<p>Overall: ".$totalHours." hours</p>";
        echo "<p>This Week: ".$weeklyHours. " hours</p>";
    }

    //Get the goals currently set for user and display
    public function displayGoals(){

        echo "<form method='POST' action='../Controller/goalController.php'>
                    <div class='form-group row'>
                        <div class='col-4'>";
        echo "                <label>Week: </label>
                        </div>
                        <div class='col-4'>
                            <input class='form-control' name='weekly' type='number' min='1' max='99' value='".$this->weekly."'>
                        </div>
                   </div>";
        echo "<div class='form-group row'>
                    <div class='col-4'>
                        <label>Daily: </label>
                    </div>
                    <div class='col-4'>
                        <input class='form-control' name='daily' type='number' min='1' max='23' value='".$this->daily."'>
                   </div>
                   </div>";
        echo "<br><div class='text-center'><button class='btn btn-success' name='updateGoal' type='submit'>Change Goals</button></div></form>";
    }

}