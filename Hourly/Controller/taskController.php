<?php
include_once 'Task_Controller.php';
include_once 'Time_Controller.php';

//Replace with session
$controller = new Task_Controller("dummy");
$timeController = new Time_Controller('dummy');

//Collect inputs to assign a task to module
if(isset($_POST['addTaskBtn'])){

    //Check if user set a deadline
    if($_POST['deadlineInput'] == "Due Anytime"){
        $due_date = "9999-12-30"; //Set to an extreme date if no deadline
        $due_time = "";
    }
    else
    {
        $split = explode(" ", $_POST['deadlineInput']);
        $due_date = $split[0];
        $due_time = $split[1];
    }

    $controller->assignTask($_POST['moduleCode'], $_POST['taskName'], $_POST['taskCategory'], $due_date, $due_time, $_POST['priorityOptions']);

    //Go to module page once created
    header('Location: ../View/module.php?code='.$_POST['moduleCode']);
}

//Edit details of an ongoing task
if(isset($_POST['editTaskBtn'])){

    if($_POST['currentDue']=="Due Anytime"){
        $due_date = "9999-12-30"; //Set to an extreme date if no deadline
        $due_time = "";
    }else{
        $split = explode(" ", $_POST['currentDue']);
        $due_date = $split[0];
        $due_time = $split[1];
    }
    echo $_POST['id']; echo " "; echo $_POST['module'];
    $controller->editTask($_POST['id'], $_POST['module'], $_POST['tName'], $_POST['category'], $due_date, $due_time, $_POST['priority']);

    //Go to module page once created
    header('Location: ../View/module.php?code='.$_POST['module']);
}

//GET request to mark task complete
if(isset($_GET['task'])){
    $controller->completeTask($_GET['task']);
    header('Location: ../View/home.php');
}

//GET request to delete task
if(isset($_GET['delTaskId'])){
    $timeController->deleteTaskTime($_GET['delTaskId']);
    $controller->deleteTask($_GET['delTaskId']);
    header('Location: ../View/home.php');
}

//GET request to view task details and time spent FROM VIEW MODULE PAGE
if(isset($_GET['taskIdModule'])){
    $controller->getTaskDetails($_GET['taskIdModule'], "Module Page");
    $timeController->outputTimes($timeController->getTaskTime($_GET['taskIdModule']));
}

//GET request to view task details and time spent FROM HOME PAGE
if(isset($_GET['taskIdHome'])){
    $controller->getTaskDetails($_GET['taskIdHome'], "Home Page");
    $timeController->outputTimes($timeController->getTaskTime($_GET['taskIdHome']));
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