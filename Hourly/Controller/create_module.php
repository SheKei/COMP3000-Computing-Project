<?php
include_once './module_controller.php';

//If create module btn clicked
if (isset($_POST['addModuleBtn'])) {
    $moduleCode = $_POST['moduleCode'];
    $moduleName = $_POST['moduleName'];
    $hours = $_POST['hours'];

    //Need to fix colour input choice
    $colour = $_POST['thisColour'];

    if($colour == ""){
        $colour="rgb(33, 37, 41)"; //If user did not select a colour, then use black
    }

    //Use session instead
    $user = "dummy";

    //Gather all inputs and send to controller
    $controller = new module_controller($user);
    $controller->createModule($moduleCode, $moduleName, $colour, $hours);

    //Go to module page once created
    header('Location: ../View/module.php?code='.$moduleCode);
}

