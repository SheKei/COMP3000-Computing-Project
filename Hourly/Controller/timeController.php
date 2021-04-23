<?php
include_once 'Time_Controller.php';
$controller = new Time_Controller('dummy');

//POST request add time to a task
if(isset($_POST['addTimeBtn'])){
    $duration = $_POST['hour'].":".$_POST['minute'];
    $timeStamp = "";

    //Check if user log is for today or another date
    if(isset($_POST['todayDate'])){
        $timeStamp = date("Y-m-d");
    }else{
        $timeStamp = $_POST['date'];
    }

    $controller->add_time($_POST['taskName'], $duration, $_POST['description'], $timeStamp);

    header('Location: ../View/home.php');
}

//POST request to log pomodoro session
if(isset($_POST['saveTimeBtn'])){
    $totalMinutes = $_POST['workedFor'];            //CONVERT TOTAL MINUTES TO HH:MM FORMAT
    $hour = (int)($totalMinutes/60);
    $minutes = $totalMinutes%60;

    $duration = $hour.":".$minutes;
    $timeStamp = date("Y-m-d");
                                                    //ADD TO DB THEN REFRESH PAGE
    $controller->add_time($_POST['taskName'], $duration, $_POST['description'], $timeStamp);
    header('Location: ../View/pomodoro.php');
}

//GET request for timeId to delete a time
if(isset($_GET['timeId'])){

    $controller->deleteTime($_GET['timeId']);
}
