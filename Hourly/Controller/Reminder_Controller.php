<?php
include_once '../Model/Database.php';
include_once '../Model/Reminder.php';

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

    //Return array of reminders
    public function getReminders(){
        $result = $this->database->getReminders($this->user);
        $reminders = [];
        if($result){
            foreach($result as $row){
                $reminder = new Reminder($row['reminder_id'], $row['description']);
                $reminders[] = $reminder;
            }
        }
        return $reminders;
    }

    //Display reminders on home page
    public function displayReminders(){
        $reminders = $this->getReminders();
        if($reminders){
            foreach ($reminders as $reminder){
                echo "<p class='reminder' id='".$reminder->getReminderId()."'>"
                    .$reminder->getDescription().
                    "</p>";
            }
        }
    }


}