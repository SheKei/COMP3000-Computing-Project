<?php
include_once 'Undo_Controller.php';
$controller = new Undo_Controller('dummy');

//GET REQUEST to undo deletion of a reminder
if (isset($_GET['undoDelReminder'])) {
    $controller->undoDeleteReminder($_GET['undoDelReminder']);
    header('Location: ../View/home.php');                               //Redirect to home page
}
