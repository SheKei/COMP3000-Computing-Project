<?php
include_once 'Undo_Controller.php';
$controller = new Undo_Controller('dummy');

//GET REQUEST to undo deletion of a reminder
if (isset($_GET['undoDelReminder'])) {
    $controller->undoDeleteReminder($_GET['undoDelReminder']);
    header('Location: ../View/home.php');                               //Redirect to home page
}

//GET REQUEST to undo deletion of a reminder
if (isset($_GET['undoDelClass'])) {
    $controller->undoDeleteClass($_GET['undoDelClass']);
    header('Location: ../View/timetable.php');                               //Redirect to home page
}
