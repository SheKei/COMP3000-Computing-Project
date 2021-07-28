<?php
include_once '../Model/Database.php';

class Undo_Controller
{
    protected $username;
    protected $database;

    /**
     * Undo_Controller constructor.
     */
    public function __construct($username, $database)
    {
        $this->username = $username;
        $this->database = new Database();
    }
        
}