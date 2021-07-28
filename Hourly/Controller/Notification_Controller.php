<?php

class Notification_Controller
{

    /**
     * Notification_Controller constructor.
     */
    public function __construct()
    {
    }

    public function displayNotification($msg){
        echo
        '<div class="alert alert-warning alert-dismissible fade show" role="alert">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        '.$msg.'<a href="#" class="alert-link"> Undo </a> 
        </div>';
    }

    public function displayReminderDeletionNotification(){
        $this->displayNotification("Reminder Deleted");
    }
}