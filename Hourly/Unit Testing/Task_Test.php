<?php
include_once '../Model/Database.php';
include_once '../Controller/Task_Controller.php';
include_once '../Model/Task.php';

use PHPUnit\Framework\TestCase;

class Task_Test extends TestCase
{
    private $db;
    private $user;
    private $task_controller;
    private $moduleCode;

    //MAKE SURE TO RUN FORTICLIENT TO TEST CALL OF DB PROCEDURES
    public function start(){
        $this->db = new Database();
        $this->user = "dummy";
        $this->task_controller = new Task_Controller($this->user);
        $this->moduleCode = "COMP3333";
    }

    public function returnId()
    {
        //Get task id
        $sql = "SELECT task_id FROM COMP3000_STong.task WHERE task_name='Task Name'";
        $this->start();
        $result = $this->db->executeStatement($sql);
        foreach($result as $row){
            $taskId = $row['task_id'];
        }
        return $taskId;
    }

    public function addTestData(){
        $taskName = "Task Name";
        $taskCategory = "Revision";
        $dueDate = "2020-12-12";
        $dueTime = "13:00";
        $priorityLevel = "Medium";

        $this->start();

        //Call controller to insert test data
        $this->task_controller->assignTask($this->moduleCode, $taskName, $taskCategory, $dueDate, $dueTime, $priorityLevel);
    }


    //Test retrieval of task details
    public function test_get_task(){
        $this->start();
        $taskId = $this->returnId();

        //Task id for test data = 8
        $result = $this->db->getTaskDetails($taskId);

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

    //Updating task status from ongoing to complete
    public function test_complete_task()
    {
        $this->start();
        $taskId = $this->returnId();

        //Update status
        $this->task_controller->completeTask($taskId);

        //Retrieve task status
        $sql = "SELECT task_status FROM COMP3000_STong.task WHERE task_id=".$taskId;
        $result = $this->db->executeStatement($sql);
        foreach($result as $row){
            $status = $row['task_status'];
            $this->assertEquals($status, "Complete");
        }
    }

    //Colour coding priority levels
    public function test_sort_priority(){
        $this->start();

        //Test Priority
        $lowPriority = $this->task_controller->sortPriority("Low");
        $expectedStyle = '<i style="color:green" class="fas fa-exclamation"></i> ';
        $this->assertEquals($lowPriority, $expectedStyle);

        $mediumPriority = $this->task_controller->sortPriority("Medium");
        $expectedStyle = '<i style="color:orange" class="fas fa-exclamation"></i> ';
        $this->assertEquals($mediumPriority, $expectedStyle);

        $highPriority = $this->task_controller->sortPriority("High");
        $expectedStyle = '<i style="color:red" class="fas fa-exclamation"></i> ';
        $this->assertEquals($highPriority, $expectedStyle);
    }

    public function test_delete_task(){
        $this->start();
        $this->addTestData();
        $taskId = $this->returnId();

        $this->task_controller->deleteTask($taskId);

        $sql = "SELECT task_id FROM COMP3000_STong.task WHERE task_id=".$taskId;
        $shouldBeNull = $this->db->executeStatement($sql);

        $this->assertEmpty($shouldBeNull);
    }
}
