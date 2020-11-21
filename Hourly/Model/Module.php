<?php


class Module
{
    private $moduleCode;
    private $moduleName;
    private $expectedHours;
    private $colour;

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

    public function getModuleCode()
    {
        return $this->moduleCode;
    }

    public function getModuleName()
    {
        return $this->moduleName;
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