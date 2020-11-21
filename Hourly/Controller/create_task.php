<?php
include_once 'task_controller.php';
include_once 'time_controller.php';

//Replace with session
$controller = new task_controller("dummy");
$timeController = new time_controller('dummy');

if(isset($_POST['addTaskBtn'])){

    $task_name = $_POST['taskName'];
    $module_code = $_POST['moduleCode'];
    $task_category = $_POST['taskCategory'];
    $priority = $_POST['priorityOptions'];

    //Check if user set a deadline
    if($_POST['dueDeadline'] == "dueAnytime"){
        $due_date = "9999-12-30"; //Set to an extreme date if no deadline
        $due_time = "";
    }
    else
    {
        $due_date = $_POST['dueDate'];
        $due_time = $_POST['dueTime'];
    }

    $controller->assignTask($module_code, $task_name, $task_category, $due_date, $due_time, $priority);

    //Go to module page once created
    header('Location: ../View/module.php?code='.$module_code);
}

//GET request to mark task complete
if(isset($_GET['task'])){
    $controller->completeTask($_GET['task']);
    header('Location: ../View/home.php');
}

//GET request to delete task
if(isset($_GET['delTaskId'])){
    $controller->deleteTask($_GET['delTaskId']);
    header('Location: ../View/home.php');
}

//GET request to view task details and time spent on a pop-up page
if(isset($_GET['taskId'])){
    $controller->getTaskDetails($_GET['taskId']);
    $timeController->outputTimes($timeController->getTaskTime($_GET['taskId']));
}