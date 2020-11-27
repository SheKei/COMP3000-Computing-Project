<?php
include_once '../Model/Database.php';
include_once '../Controller/Module_Controller.php';
include_once '../Controller/Task_Controller.php';
include_once '../Controller/Time_Controller.php';
include_once '../Model/Task.php';
include_once '../Model/Time.php';

use PHPUnit\Framework\TestCase;

class Time_Test extends TestCase
{
    private $db;
    private $user;
    private $time_controller;

    //MAKE SURE TO RUN FORTICLIENT TO TEST CALL OF DB PROCEDURES
    public function start(){
        $this->db = new Database();
        $this->user = "dummy";
        $this->time_controller = new Time_Controller($this->user);
    }

    //Add time to a task and retrieve time
    public function test_get_time(){
        $taskId = 8;
        $duration = "1:00";
        $description = "Test Description";
        $timestamp = "2020-11-22";

        $this->start();

        //Add test data
        $this->time_controller->add_time($taskId, $duration, $description, $timestamp);

        //Retrieve test data back in an array
        $result = $this->time_controller->getTaskTime($taskId);

        foreach($result as $time){
            $this->assertEquals($time->getDescription(), $description);
            $this->assertEquals($time->getDuration(), "01:00:00");
            $this->assertEquals($time->getTimestamp(), "2020-11-22");
        }
    }

    //Delete time
    public function test_delete_time(){
        $taskId = 8;

        $this->start();

        //Get time id
        $sql = "SELECT time_id FROM COMP3000_STong.time_log WHERE description='Test Description'";
        $result = $this->db->executeStatement($sql);
        foreach($result as $row){
            $timeId = $row['time_id'];
        }

        //Delete time
        $this->db->deleteTime($timeId);

        //Retrieve using same time id
        $sql = "SELECT time_id FROM COMP3000_STong.time_log WHERE time_id=".$timeId;
        $shouldBeNull = $this->db->executeStatement($sql);

        $this->assertEmpty($shouldBeNull);
    }
}
