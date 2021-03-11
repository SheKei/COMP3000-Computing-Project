<?php
include_once 'Reminder_Controller.php';
$controller = new Reminder_Controller('dummy');

//Collect input when add reminder btn clicked
if (isset($_POST['addReminder'])) {
    $controller->addReminder($_POST['reminder']);
    //Redirect to home page
    header('Location: ../View/home.php');
}

//GET REQUEST to delete reminder
if (isset($_GET['reminderID'])) {
    $controller->deleteReminder($_GET['reminderID']);
    //Redirect to home page
    header('Location: ../View/home.php');
}