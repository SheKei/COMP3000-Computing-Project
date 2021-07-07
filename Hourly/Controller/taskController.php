<?php
include_once 'Task_Controller.php';
include_once 'Time_Controller.php';

//Replace with session
$controller = new Task_Controller("dummy");
$timeController = new Time_Controller('dummy');

//Collect inputs to assign a task to module
if(isset($_POST['addTaskBtn'])){

    $task_name = $_POST['taskName'];
    $module_code = $_POST['moduleCode'];
    $task_category = $_POST['taskCategory'];
    $priority = $_POST['priorityOptions'];

    //Check if user set a deadline
    if($_POST['deadlineInput'] == "Due Anytime"){
        $due_date = "9999-12-30"; //Set to an extreme date if no deadline
        $due_time = "";
    }
    else
    {
        echo $_POST['deadlineInput'];
        $split = explode(" ", $_POST['deadlineInput']);
        $due_date = $split[0];
        $due_time = $split[1];
    }

    $controller->assignTask($module_code, $task_name, $task_category, $due_date, $due_time, $priority);

    //Go to module page once created
    header('Location: ../View/module.php?code='.$module_code);
}

//Edit details of an ongoing task
if(isset($_POST['editTaskBtn'])){

    $taskId = $_POST['id'];
    $task = $_POST['tName'];
    $module = $_POST['module'];
    $category = $_POST['category'];
    $priority = $_POST['priority'];

    //Check if user set a deadline
    if($_POST['date'] == ""){
        $due_date = "9999-12-30"; //Set to an extreme date if no deadline
        $due_time = "";
    }
    else
    {
        $due_date = $_POST['newDate'];
        $due_time = $_POST['newTime'];
    }

    $controller->editTask($taskId, $module, $task, $category, $due_date, $due_time, $priority);

    //Go to module page once created
    header('Location: ../View/module.php?code='.$module);
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

//GET request to view task details and time spent on a pop-up page
if(isset($_GET['completedTaskId'])){
    $controller->displayCompletedTaskDetails($_GET['completedTaskId']);
    $timeController->outputTimes($timeController->getTaskTime($_GET['completedTaskId']));
}

//GET request to update task status to complete
if(isset($_GET['completeTaskId'])){
    $controller->completeTask($_GET['completeTaskId']);
    header('Location: ../View/home.php');
}