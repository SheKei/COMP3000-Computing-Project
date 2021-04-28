<?php
include_once 'Goal_Controller.php';
$goalController = new Goal_Controller('dummy');

//POST request to update hourly goals
if (isset($_POST['updateGoal'])) {
    $goalController->updateWeeklyGoal($_POST['weekly']);
    $goalController->updateDailyGoal($_POST['daily']);

    //Go back to account page once done
    header('Location: ../View/account.php');
}
