<?php
include_once '../Model/Database.php';
include_once '../Model/Deadline.php';
include_once 'Task_Controller.php';

class Deadline_Controller extends Task_Controller //Inherit priority sorting function
{

    //Get upcoming task deadlines for the next seven days
    public function getDeadlines(){
        $result = $this->database->getDeadlines($this->username);
        $deadlines = [];
        if($result){
            foreach ($result as $row){
                $deadline = new Deadline($row['module_code'], $row['task_id'], $row['task_name'], $row['due_date'], $row['due_time'], $row['priority_level']);
                $deadlines[] = $deadline;
            }
            return $deadlines;
        }else{
            return null;
        }
    }

    //Display deadlines due for the next seven days
    public function displayDeadlines(){
        $deadlines = $this->getDeadlines();
        if($deadlines){
            foreach ($deadlines as $deadline){
                $priorityIcon = $this->sortPriority($deadline->getPriorityLevel());
                $deadlineDate = $this->formatStringDate($deadline->getDueDate(), $deadline->getDueTime());
                echo "<p class='upcomingDeadline'>".$priorityIcon.'<button class="btn taskBtn" id="'.$deadline->getTaskId()
                    .'" data-toggle="modal" data-target="#viewTask">'.$deadline->getTaskName()."</button> - ".$deadlineDate."</p>";
            }
        }
    }

    //Return format date string to d/m h:m
    public function formatStringDate($date, $time){
        $icon = '<i class="far fa-calendar-alt"></i>'; //Calender icon
        $due = $icon." ".date("d/m h:m", strtotime($date." ".$time));

        return $due;
    }

    //Display the deadline period when tasks are alerted n days before deadline
    public function displayDeadlinePeriod($deadlinePeriod){
        echo "<form method='POST' action='../Controller/deadlineController.php'>";
        echo "<div class='form-group row'><div class='col-auto'><p>Show tasks </p></div>";
        echo "<div class='col-auto'>
              <input class='form-control' name='deadlinePeriod' id='deadlinePeriod' type='number' 
              min='1' max='40' value='".$deadlinePeriod."' required></div>";
        echo "<div class='col-auto'><p> days before the deadline date</p></div><br>";
        echo "<button class='btn btn-success' name='updateGoal' type='submit'>Change Deadline Period</button>";

    }

    public function getDeadlinePeriod(){
        $result = $this->database->getDeadlinePeriod($this->username);
        $deadlinePeriod = "";
        if($result){
            foreach($result as $row){
                $deadlinePeriod = $row['deadline_period'];
            }
            $this->displayDeadlinePeriod($deadlinePeriod);
        }
    }


}