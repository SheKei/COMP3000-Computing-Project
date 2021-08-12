<?php
include_once 'Reminder_Controller.php';
$controller = new Reminder_Controller('dummy');

//POST request Collect input when add reminder btn clicked
if (isset($_POST['addReminder'])) {
    $controller->addReminder($_POST['reminder']);
    header('Location: ../View/home.php');                               //Redirect to home page
}

//GET REQUEST to delete reminder
if (isset($_GET['reminderID'])) {
    $controller->deleteReminder($_GET['reminderID']);
    //Redirect with reminder id back to home page in case user wishes to undo delete
    header('Location: ../View/home.php?deleteReminder='.$_GET['reminderID']);
}

//AJAX REQUEST to view/edit a reminder
if (isset($_GET['editReminderID'])) {
    $controller->displayReminderOnPopup($_GET['editReminderID']);               //Display reminder contents
}

//POST REQUEST to save edit of reminder
if (isset($_POST['saveEditReminder'])) {
    $controller->saveEditReminder($_POST['reminderID'], $_POST['editDescription']);
    header('Location: ../View/home.php');                               //Redirect to home page
}
