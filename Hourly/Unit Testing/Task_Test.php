<?php
include_once '../Model/Database.php';
include_once '../Controller/Module_Controller.php';
include_once '../Controller/Task_Controller.php';
include_once '../Model/Task.php';

use PHPUnit\Framework\TestCase;

class Task_Test extends TestCase
{
    private $db;
    private $user;
    private $module_controller;
    private $task_controller;
    private $moduleCode;

    //MAKE SURE TO RUN FORTICLIENT TO TEST CALL OF DB PROCEDURES
    public function start(){
        $this->db = new Database();
        $this->user = "dummy";
        $this->module_controller = new Module_Controller($this->user);
        $this->task_controller = new Task_Controller($this->user);
        $this->moduleCode = "COMP3333";
    }

    //Test retrieval of task details
    public function test_get_task(){
        $taskName = "Task Name";
        $taskCategory = "Revision";
        $dueDate = "12-12-2020";
        $dueTime = "13:00";
        $priorityLevel = "Medium";

        //Call controller to call db procedure
        //$this->task_controller->assignTask($this->moduleCode, $taskName, $taskCategory, $dueDate, $dueTime, $priorityLevel);

        $this->start();

        //Task id for test data = 8
        $result = $this->db->getTaskDetails(8);

        if($result){
            foreach($result as $row){
                $task = new Task(8, $row['task_name'], $row['task_category'], $row['due_date'], $row['due_time'], $row['priority_level']);
            }
        }

        $this->assertEquals($task->getTaskId(), 8);
        $this->assertEquals($task->getTaskName(), "Task Name");
        $this->assertEquals($task->getTaskCategory(), "Revision");
        $this->assertEquals($task->getPriorityLevel(), "Medium");
        $this->assertEquals($task->getDueTime(), "13:00:00");
        $this->assertEquals($task->getDueDate(), "2020-12-12");
    }

}
