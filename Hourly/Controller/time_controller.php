<?php
include_once '../Model/Database.php';
include_once '../Model/Time.php';

class time_controller
{
    private $username;
    private $database;
    /**
     * time_controller constructor.
     */
    public function __construct($user)
    {
        $this->database = new Database();
        $this->username = $user;
    }

    //Add time spent working on an ongoing task
    public function add_time($task, $duration, $description, $timeStamp){
        $this->database->addTime($task, $duration, $description, $timeStamp);
    }

    //Get time spent on a task
    public function getTaskTime($taskId){
        $result = $this->database->getTaskTime($taskId);
        $times = [];
        if($result){
            foreach($result as $row){
                $time = new Time($row['time_id'], $row['duration'], $row['description'], $row['time_stamp']);
                $times[] = $time;
            }
        }
        return $times;
    }

    //Output array of time logs spent on a task
    public function outputTimes($times){
        echo '<section id="timings">';
        foreach($times as $time){
            $btn = '<button class="btn deleteTime" id="'.$time->getTimeId().'"><i class="fas fa-times"></i></button>';
            echo '<p>'.$btn.$time->getDuration().' hrs - '.'<i>'.$time->getDescription().' - </i> <b>'.$time->getTimestamp().'</b></p>';
        }
        echo "</section>";
    }

    //Delete time spent on a task
    public function deleteTime($taskId){
        $this->database->deleteTime($taskId);
    }
}