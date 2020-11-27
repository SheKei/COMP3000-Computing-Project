<?php
include_once '../Model/Database.php';

class Class_Controller
{
    private $user;
    private $database;

    /**
     * Class_Controller constructor.
     * @param $user
     * @param $database
     */
    public function __construct($user)
    {
        $this->user = $user;
        $this->database = new Database();
    }

    //Add a class to timetable
    public function addClass($module, $name, $room, $day, $time, $duration){
        $this->database->addClass($this->user, $module, $name, $room, $day, $time, $duration);
    }


}