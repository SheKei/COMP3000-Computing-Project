<?php
include_once '../Model/Database.php';
include_once '../Model/Time.php';

class Time_Controller
{
    private $username;
    private $database;
    /**
     * Time_Controller constructor.
     */
    public function __construct($user)
    {
        $this->database = new Database();
        $this->username = $user;
    }

    //Add time spent working on an ongoing task
    public function add_time($task, $duration, $description, $timeStamp){
        $this->database->addTime($this->username,$task, $duration, $description, $timeStamp);
    }

    //Get time spent on a task
    public function getTaskTime($taskId){
        $result = $this->database->getTaskTime($taskId);
        $times = [];
        if($result){
            foreach($result as $row){//For each result, convert to a time object
                $time = new Time($row['time_id'], $row['duration'], $row['description'], $row['time_stamp']);
                $times[] = $time;
            }
        }
        return $times;
    }

    //Output array of time logs spent on a task as paragraphs
    public function outputTimes($times){
        echo '<section id="timings">';
        echo '<h3 style="font-family: \'Century Gothic\'">Study Logs</h3>';
        foreach($times as $time){
            $btn = '<button class="btn deleteTime" id="'.$time->getTimeId().'"><i class="fas fa-times"></i></button>';
            echo '<p id="id'.$time->getTimeId().'">'.$btn.$time->getDuration().' hrs - '.'<i>'.$time->getDescription().' - </i> <b>'.$time->getTimestamp().'</b></p>';
        }
        echo "</section>";

        echo //JQUERY TO DELETE A TIME
        '<script>
                $(function() {
                    
                    $(".deleteTime").click(function(){
                    let timeId = this.id; //GET ID OF TIME TO BE DELETED
                    if(timeId){
                        let xml = new XMLHttpRequest();
                        
                        xml.onreadystatechange = function() { //Wait for response
                        if (xml.readyState == 4 && xml.status == 200) {
                            $("#id"+timeId).addClass("delete"); //HIDE DELETED TIME 
                            }
                        }
                        xml.open("GET","../Controller/timeController.php?timeId="+timeId,true); //Send time id to delete record
                        xml.send();
                    }
                });
            });
        </script>';
    }

    //Delete time spent on a task
    public function deleteTime($timeId){
        $this->database->deleteTime($timeId);
    }

    //Delete all time logs first before a task is deleted
    public function deleteTaskTime($taskId){
        $result = $this->database->getTaskTime($taskId);
        if($result){
            foreach($result as $row){ //Archive before deleting in table
                $this->database->archiveTime($row['time_id']);
                $this->database->deleteTime($row['time_id']);
            }
        }
    }
}