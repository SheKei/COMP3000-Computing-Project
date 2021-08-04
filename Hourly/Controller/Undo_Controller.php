<?php
include_once '../Model/Database.php';

class Undo_Controller
{
    protected $username;
    protected $database;

    /**
     * Undo_Controller constructor.
     */
    public function __construct($username)
    {
        $this->username = $username;
        $this->database = new Database();
    }

    //Check archive record exists first before moving back to record table
    public function undoDeleteReminder($reminderID){
        $this->database->checkArchiveReminder($reminderID);
    }

    //Check archived class exists before moving back to class table
    public function undoDeleteClass($classID){
        $this->database->checkArchiveClass($classID);
    }

    public function undoDeleteTask($taskID){
        $moduleCode = $this->database->getModuleCodeFromTaskID($taskID);
        $this->database->checkArchiveTask($taskID);
        return $moduleCode;
    }
}