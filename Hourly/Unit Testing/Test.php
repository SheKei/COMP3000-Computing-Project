<?php
include_once '../Model/Database.php';
include_once '../Controller/Module_Controller.php';

use PHPUnit\Framework\TestCase;

class Test extends TestCase
{
    private $db;
    private $user;
    private $controller;


    public function start(){
        $this->db = new Database();
        $this->user = "dummy";
        $this->controller = new Module_Controller($this->user);
    }

    //Retrieving module's details
    public function test_get_module(){
        $moduleCode = "COMP3333";
        $moduleName = "Test Module";
        $colour = "rgb(33, 37, 41)";
        $expectedHours = 300;

        $this->start();

        //RUN ONLY ONCE UNTIL DELETE MODULE IMPLEMENTED!!!
        //$this->db->addModule($this->user, $moduleCode, $moduleName, $colour, $expectedHours);

        //Get module details from module code
        $module = $this->controller->displayModulePage("COMP3333");

        //Test if details match
        $this->assertEquals($module->getModuleCode(), "COMP3333");
        $this->assertEquals($module->getModuleName(), "Test Module");
        $this->assertEquals($module->getColour(), "rgb(33, 37, 41)");
        $this->assertEquals($module->getExpectedHours(), 300);
    }

}
