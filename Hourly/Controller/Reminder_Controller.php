<?php
include_once '../Model/Database.php';

class Reminder_Controller
{
    private $user;
    private $database;

    public function __construct($user)
    {
        $this->user = $user;
        $this->database = new Database();
    }

    //Collect description input to add a reminder
    public function addReminder($description){
        $this->database->addReminder($this->user, $description);
    }


}