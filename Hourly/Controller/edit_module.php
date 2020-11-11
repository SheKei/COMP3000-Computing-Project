<?php
include_once 'module_controller.php';

if(isset($_POST['saveBtn'])) {
    $controller = new module_controller('dummy');
    //echo  $_POST['moduleCodeCurrent'];
    $controller->updateModuleDetails($_POST['moduleCode'], $_POST['moduleName'], $_POST['thisColour'], $_POST['hours'], $_POST['moduleCodeCurrent']);
    header('Location: ../View/module.php?code='.$_POST['moduleCode']);
}