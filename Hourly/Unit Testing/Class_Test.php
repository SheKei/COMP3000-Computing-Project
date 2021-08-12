<?php
include_once '../Model/Database.php';
include_once '../Controller/Class_Controller.php';

use PHPUnit\Framework\TestCase;

class ClassTest extends TestCase
{
    private $db;
    private $user;
    private $controller;

    //MAKE SURE TO RUN FORTICLIENT TO TEST CALL OF DB PROCEDURES
    public function start(){
        $this->db = new Database();
        $this->user = "dummy";
        $this->controller = new Class_Controller($this->user);
    }

    public function test_add_class(){
        $module = "BIO1234";
        $name = "Class Test";
        $room = "Online";
        $day = "1";
        $time = "09:00";
        $duration = "1:00";

        $return = $this->controller->addClass($module, $name, $room, $day, $time, $duration);
        $this->assertEquals($return, "BIO1234");

    }
}
