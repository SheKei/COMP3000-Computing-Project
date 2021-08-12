<?php

class Notification_Controller
{

    /**
     * Notification_Controller constructor.
     */
    public function __construct()
    {
    }

    public function displayNotification($msg, $hrefLink){
        echo
        '<div class="alert alert-warning alert-dismissible fade show" role="alert">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        '.$msg.'<a href="'.$hrefLink.'" class="alert-link"> Undo </a> 
        </div>';
    }

    //Display reminder that a reminder has been deleted and the option to undo
    public function displayReminderDeletionNotification($undoID){
        $this->displayNotification("Reminder Deleted", "../Controller/undoController.php?undoDelReminder=".$undoID);
    }

    //Display a class has been deleted and the option to undo
    public function displayClassDeletionNotification($undoID){
        $this->displayNotification("Class Deleted", "../Controller/undoController.php?undoDelClass=".$undoID);
    }

    //Display a task and its time spent have been delete with the option to undo
    public function displayTaskDeletionNotification($undoID){
        $this->displayNotification("Task Deleted", "../Controller/undoController.php?undoDelTask=".$undoID);
    }
}