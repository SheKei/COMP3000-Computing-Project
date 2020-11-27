<?php
include_once 'Class_Controller.php';
$controller = new Class_Controller('dummy');

//Collect all inputs when add class btn clicked
if (isset($_POST['classBtn'])) {
    $moduleCode = $_POST['moduleCode'];
    $className = $_POST['className'];
    $classRoom = $_POST['classRoom'];
    $classDay = $_POST['classDay'];
    $startTime = $_POST['startTime'];
    $classDuration = $_POST['hour'].":".$_POST['minutes'];

    $controller->addClass($moduleCode,$className, $classRoom, $classDay, $startTime, $classDuration);

    header('Location: ../View/home.php');
}