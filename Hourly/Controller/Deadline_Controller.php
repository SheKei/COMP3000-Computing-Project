<?php
include_once '../Model/Database.php';
include_once '../Model/Deadline.php';

class Deadline_Controller
{
    private $user;
    private $database;

    public function __construct($user)
    {
        $this->user = $user;
        $this->database = new Database();
    }

    //Get upcoming task deadlines for the next seven days
    public function getDeadlines(){
        $result = $this->database->getDeadlines($this->user);
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
                echo "<p>".$deadline->getTaskName()."</p>";
            }
        }
    }
}