<?php
include_once '../Model/Database.php';
include_once '../Controller/Reminder_Controller.php';

use PHPUnit\Framework\TestCase;

class Reminder_Test extends TestCase
{
    private $db;
    private $user;
    private $controller;

    //MAKE SURE TO RUN FORTICLIENT TO TEST CALL OF DB PROCEDURES
    public function start(){
        $this->db = new Database();
        $this->user = "dummy";
        $this->controller = new Reminder_Controller($this->user);
    }

    public function test_get_reminders(){
        $result = $this->controller->getReminders();
        $this->assertNotNull($result);
    }
}
