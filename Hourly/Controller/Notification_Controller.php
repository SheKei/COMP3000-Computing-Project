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

    public function displayReminderDeletionNotification($undoID){
        $this->displayNotification("Reminder Deleted", "../Controller/undoController.php?undoDelReminder=".$undoID);
    }

    //public function displayClassDeletionNotification(){
        //$this->displayNotification("Class Deleted");
    //}
}