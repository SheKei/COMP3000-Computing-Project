<?php
include_once '../Model/Database.php';
include_once '../Controller/Class_Controller.php';

use PHPUnit\Framework\TestCase;

class Class_Test extends TestCase
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
        $name = "Class GoalTest";
        $room = "Online";
        $day = "1";
        $time = "09:00";
        $duration = "1:00";

        $return = $this->controller->addClass($module, $name, $room, $day, $time, $duration);
        $this->assertEquals($return, "BIO1234");

    }

    public function test_delete_class(){
        $classId = 14;
        $this->controller->deleteClass($classId);
    }

    public function test_update_attendance(){
        $classId = 14;
        $this->controller->updateAttendance($classId);
    }

    public function test_get_classes_by_module(){
        $result = $this->controller->getTimetableByModule();
        $this->assertNotNull($result);
    }

    public function test_get_classes_by_day(){
        $result = $this->controller->getTimetableByDay();
        $this->assertNotNull($result);
    }
}
