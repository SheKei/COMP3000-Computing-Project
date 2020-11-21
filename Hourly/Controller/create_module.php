<?php
include_once './module_controller.php';

//Use session instead
$user = "dummy";
$controller = new module_controller($user);

//If create module btn clicked
if (isset($_POST['addModuleBtn'])) {
    $moduleCode = $_POST['moduleCode'];
    $moduleName = $_POST['moduleName'];
    $hours = $_POST['hours'];

    $colour = $_POST['thisColour'];

    if($colour == ""){
        $colour="rgb(33, 37, 41)"; //If user did not select a colour, then use black
    }
    $controller->createModule($moduleCode, $moduleName, $colour, $hours);

    //Go to module page once created
    header('Location: ../View/module.php?code='.$moduleCode);
}

//If edit module btn clicked
if(isset($_POST['saveModuleBtn'])) {
    $controller->updateModuleDetails($_POST['code'], $_POST['name'], $_POST['theColour'], $_POST['hour'], $_POST['moduleCodeCurrent']);
    header('Location: ../View/module.php?code='.$_POST['code']);
}
