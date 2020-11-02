<?php
include_once "../Model/Database.php";

class module_controller
{
    private $database;
    private $username;
    /**
     * module_controller constructor.
     */
    public function __construct($user)
    {
        $this->database = new Database();
        $this->username = $user;
    }

    public function createModule($moduleCode, $moduleName, $colour, $expectedHours){
        $this->database->addModule($this->username,$moduleCode, $moduleName, $colour, $expectedHours);
    }
}