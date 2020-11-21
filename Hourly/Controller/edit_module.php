<?php
include_once 'module_controller.php';
$controller = new module_controller('dummy');

if(isset($_POST['saveModuleBtn'])) {
    $controller->updateModuleDetails($_POST['code'], $_POST['name'], $_POST['theColour'], $_POST['hour'], $_POST['moduleCodeCurrent']);
    header('Location: ../View/module.php?code='.$_POST['code']);
}