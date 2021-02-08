<?php
include_once './Account_Controller.php';
$controller = new Account_Controller('dummy');

//Update email and date of birth
if (isset($_POST['editAccountBtn'])) {
    $email = $_POST['email'];
    $birthdate = $_POST['birthdate'];

    $controller->updateAccount($email, $birthdate);

    header('Location: ../View/account.php');
}