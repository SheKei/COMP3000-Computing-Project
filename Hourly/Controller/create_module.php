<?php
include_once './module_controller.php';

//If create module btn clicked
if (isset($_POST['addModuleBtn'])) {
    $moduleCode = $_POST['moduleCode'];
    $moduleName = $_POST['moduleName'];
    $hours = $_POST['hours'];
    //Need to fix colour input choice
    $defaultColour = 'black';

    //Use session instead
    $user = "dummy";

    //Gather all inputs and send to controller
    $controller = new module_controller($user);
    $controller->createModule($moduleCode, $moduleName, $defaultColour, $hours);

    //Replace with module page once view module implemented
    header('Location: ../View/home.php');
}

