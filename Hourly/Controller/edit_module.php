<?php
include_once 'module_controller.php';

if(isset($_POST['saveBtn'])) {
    $controller = new module_controller('dummy');
    //echo  $_POST['moduleCodeCurrent'];
    $controller->updateModuleDetails($_POST['code'], $_POST['name'], $_POST['theColour'], $_POST['hour'], $_POST['moduleCodeCurrent']);
    header('Location: ../View/module.php?code='.$_POST['moduleCode']);
}