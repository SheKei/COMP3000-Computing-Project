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
        $this->database->addReminder($this->user, $description, date("Y-m-d"));
    }

    //Return array of reminders
    public function getReminders(){
        $result = $this->database->getReminders($this->user);//Call database to return reminders made by user
        $reminders = [];
        if($result){
            foreach($result as $row){//For each result convert to a reminder object
                $reminder = new Reminder($row['reminder_id'], $row['description'], $row['datestamp']);
                $reminders[] = $reminder;
            }
        }
        return $reminders;
    }

    //Display reminders on home page
    public function displayReminders(){
        $reminders = $this->getReminders(); //Get array of reminder objects
        if($reminders){
            foreach ($reminders as $reminder){//For each result, append to reminders board
                echo "<p>"
                    ."<i class='far fa-times-circle' id='".$reminder->getReminderId()."'></i><span data-toggle='modal' data-target='#editReminderModal' class='theReminder' id='id".$reminder->getReminderId()."'>"
                    .$reminder->getDescription()."  <strong>".date("d/m/y", strtotime($reminder->getDatestamp())).
                    "</strong></span></p>";
            }
        }
    }

    //Display selected reminder in a pop up form for editing
    public function displayReminderOnPopup($reminderID){
        $result = $this->database->getOneReminder($reminderID);//Get the details of selected reminder
        if($result){
            echo "<form method='post' action='../Controller/reminderController.php'>";
            echo "<input class='hidden' name='reminderID' value='".$reminderID."' readonly>";
            echo "<p id='editReminderMsg'></p>";
            foreach($result as $row){ //Output onto pop up page
                echo "<textarea 
                        id='editDescription' name='editDescription' class='form-control userInput' maxlength='150' 
                        cols='60' rows='7' required>".$row['description']
                    ."</textarea>";
            }
            echo "<br><button type='submit' class='btn btn-success float-right' name='saveEditReminder' id='saveEditReminder'>Save Edit Reminder</button></form>";
        }
    }

    //Save edit of reminder
    public function saveEditReminder($id, $description){
        $this->database->editReminder($id, $description, date("Y-m-d")); //Call database to save changes
    }

    //Delete a reminder using id
    public function deleteReminder($reminderID){
        $this->database->deleteReminder($reminderID);//Call database to delete reminder
    }


}