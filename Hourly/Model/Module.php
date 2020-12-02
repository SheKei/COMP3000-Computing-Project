<?php
include_once 'Module_Assignment.php';

class Module extends Module_Assignment
{
    protected $expectedHours;
    protected $colour;

    /**
     * Module constructor.
     * @param $moduleCode
     * @param $moduleName
     * @param $expectedHours
     * @param $colour
     */
    public function __construct($moduleCode, $moduleName, $expectedHours, $colour)
    {
        $this->moduleCode = $moduleCode;
        $this->moduleName = $moduleName;
        $this->expectedHours = $expectedHours;
        $this->colour = $colour;
    }


    public function getExpectedHours()
    {
        return $this->expectedHours;
    }

    //Returns rgb value
    public function getColour()
    {
        return $this->colour;
    }

}