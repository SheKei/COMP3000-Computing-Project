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

//GET class id to retrieve details of a class
if(isset($_GET['classId'])){
    $controller->getClassDetails($_GET['classId']);
}

//POST request to save edit on class details
if (isset($_POST['editClassBtn'])) {
    $controller->editClass($_POST['idClass'],$_POST['moduleAssigned'],$_POST['theClassName'], $_POST['room'], $_POST['day'], $_POST['time'], $_POST['duration']);
    header('Location: ../View/timetable.php');
}   //return to timetable page

//GET request to delete class
if(isset($_GET['deleteClassId'])){
    $controller->deleteClass($_GET['deleteClassId']);
    header('Location: ../View/timetable.php');
}