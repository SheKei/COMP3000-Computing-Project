<?php


class Deadline
{
    protected $moduleCode;
    protected $taskId;
    protected $taskName;
    protected $dueDate;
    protected $dueTime;
    protected $priorityLevel;

    public function __construct($moduleCode, $taskId, $taskName, $dueDate, $dueTime, $priorityLevel)
    {
        $this->moduleCode = $moduleCode;
        $this->taskId = $taskId;
        $this->taskName = $taskName;
        $this->dueDate = $dueDate;
        $this->dueTime = $dueTime;
        $this->priorityLevel = $priorityLevel;
    }

    public function getModuleCode()
    {
        return $this->moduleCode;
    }

    public function getTaskId()
    {
        return $this->taskId;
    }

    public function getTaskName()
    {
        return $this->taskName;
    }

    public function getDueDate()
    {
        return $this->dueDate;
    }

    public function getDueTime()
    {
        return $this->dueTime;
    }

    public function getPriorityLevel()
    {
        return $this->priorityLevel;
    }



}