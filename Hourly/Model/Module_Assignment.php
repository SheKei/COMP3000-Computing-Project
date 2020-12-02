<?php


class Module_Assignment
{
    protected $moduleCode;
    protected $moduleName;

    /**
     * Module_Assignment constructor.
     * @param $moduleCode
     * @param $moduleName
     */
    public function __construct($moduleCode, $moduleName)
    {
        $this->moduleCode = $moduleCode;
        $this->moduleName = $moduleName;
    }

    public function getModuleCode()
    {
        return $this->moduleCode;
    }

    public function getModuleName()
    {
        return $this->moduleName;
    }

}