<?php
include_once 'task_controller.php';

if(isset($_POST['addTaskBtn'])){

    $task_name = $_POST['taskName'];
    $module_code = $_POST['moduleCode'];
    $task_category = $_POST['taskCategory'];
    $priority = $_POST['priorityOptions'];

    if($_POST['dueDeadline'] == "dueAnytime"){
        $due_date = "9999-12-30"; //Set to an extreme date
        $due_time = "";
    }
    else
    {
        $due_date = $_POST['dueDate'];
        $due_time = $_POST['dueTime'];
    }


    //Replace with session
    $controller = new task_controller("dummy");
    $controller->assignTask($module_code, $task_name, $task_category, $due_date, $due_time, $priority);

    //Replace with module page once view module implemented
    header('Location: ../View/home.php');


}