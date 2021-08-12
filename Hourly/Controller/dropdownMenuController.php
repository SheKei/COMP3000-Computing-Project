<?php
include_once 'Dropdown_Menu_Controller.php';
$controller = new Dropdown_Menu_Controller('dummy');

// GET request to change the output of tasks depending on the module chosen
if(isset($_GET['moduleCodeMenu'])){
    $controller->displayModuleTasks($_GET['moduleCodeMenu']);
}