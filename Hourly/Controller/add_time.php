<?php
include_once 'time_controller.php';

//When user adds time to a task
if(isset($_POST['addTimeBtn'])){
    $controller = new time_controller('dummy');

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
