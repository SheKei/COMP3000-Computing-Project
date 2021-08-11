<?php
include_once 'Deadline_Controller.php';
$controller = new Deadline_Controller('dummy');

//POST REQUEST FORM to change the deadline period
if (isset($_POST['updatePeriodBtn'])) {
    $controller->updateDeadlinePeriod($_POST['deadlinePeriod']);
    header('Location: ../View/account.php');//Go back to account page
}