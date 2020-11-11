<?php
include_once '../Model/Database.php';

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
}