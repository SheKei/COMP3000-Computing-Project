<?php
include_once 'Dropdown_Menu_Controller.php';
$controller = new Dropdown_Menu_Controller('dummy');

if(isset($_GET['moduleCodeMenu'])){
    $controller->displayModuleTasks($_GET['moduleCodeMenu']);
}