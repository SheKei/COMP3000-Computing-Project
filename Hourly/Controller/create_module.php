<?php
include_once './module_controller.php';

if (isset($_POST['addModuleBtn'])) {
    $moduleCode = $_POST['moduleCode'];
    $moduleName = $_POST['moduleName'];
    $hours = $_POST['hours'];
    //Need to fix colour input choice
    $defaultColour = 'black';
    $user = "dummy";

    $controller = new module_controller($user);
    $controller->createModule($moduleCode, $moduleName, $defaultColour, $hours);
    header('Location: ../View/home.php');
}

