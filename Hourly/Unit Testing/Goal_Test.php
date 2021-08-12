<?php
include_once '../Model/Database.php';
include_once '../Controller/Goal_Controller.php';

use PHPUnit\Framework\TestCase;

class Goal_Test extends TestCase
{
    private $db;
    private $user;
    private $controller;

    //MAKE SURE TO RUN FORTICLIENT TO TEST CALL OF DB PROCEDURES
    public function start(){
        $this->db = new Database();
        $this->user = "dummy";
        $this->controller = new Goal_Controller($this->user);
    }

    public function test_get_overall_weekly_hours(){
        $result = $this->controller->getOverallWeeklyHours();
        $this->assertNotNull($result);
    }

    public function test_get_today_hours(){
        $result = $this->controller->getTodaysHours();
        $this->assertNotNull($result);
    }

    public function test_get_module_hours(){
        $result = $this->controller->getTotalHoursOnModule("BIO1234");
        $this->assertNotNull($result);
    }
}
