<?php
include_once 'Module_Assignment.php';

class Module_Class extends Module_Assignment //Inherit module code and module name attribute
{
    protected $classId;
    protected $className;
    protected $classRoom;
    protected $classDay;
    protected $startTime;
    protected $classDuration;
    protected $lastAttendance;
    protected $timesAttended;

    public function __construct($moduleCode, $moduleName, $classId, $className, $classRoom, $classDay, $startTime, $classDuration, $lastAttendance, $timesAttended)
    {
        $this->moduleCode = $moduleCode;
        $this->moduleName = $moduleName;
        $this->classId = $classId;
        $this->className = $className;
        $this->classRoom = $classRoom;
        $this->classDay = $classDay;
        $this->startTime = $startTime;
        $this->classDuration = $classDuration;
        $this->lastAttendance = $lastAttendance;
        $timesAttended = $timesAttended;
    }

    public function getClassId()
    {
        return $this->classId;
    }

    public function getClassName()
    {
        return $this->className;
    }

    public function getClassRoom()
    {
        return $this->classRoom;
    }

    public function getClassDay()
    {
        return $this->classDay;
    }

    public function getStartTime()
    {
        return $this->startTime;
    }

    public function getClassDuration()
    {
        return $this->classDuration;
    }

    public function getLastAttendance()
    {
        return $this->lastAttendance;
    }

    public function getTimesAttended()
    {
        return $this->timesAttended;
    }






}