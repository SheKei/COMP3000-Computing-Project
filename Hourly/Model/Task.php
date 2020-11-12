<?php


class Task
{
    private $taskId;
    private $taskName;
    private $taskCategory;
    private $dueDate;
    private $dueTime;
    private $priorityLevel;

    /**
     * Task constructor.
     * @param $taskId
     * @param $taskName
     * @param $taskCategory
     * @param $dueDate
     * @param $dueTime
     * @param $priorityLevel
     */
    public function __construct($taskId, $taskName, $taskCategory, $dueDate, $dueTime, $priorityLevel)
    {
        $this->taskId = $taskId;
        $this->taskName = $taskName;
        $this->taskCategory = $taskCategory;
        $this->dueDate = $dueDate;
        $this->dueTime = $dueTime;
        $this->priorityLevel = $priorityLevel;
    }

    public function getTaskId()
    {
        return $this->taskId;
    }

    public function getTaskName()
    {
        return $this->taskName;
    }

    public function getTaskCategory()
    {
        return $this->taskCategory;
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