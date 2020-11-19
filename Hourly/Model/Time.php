<?php


class Time
{
    private $timeId;
    private $duration;
    private $description;
    private $timestamp;

    /**
     * Time constructor.
     * @param $timeId
     * @param $duration //time spent on a task
     * @param $description //optional note about time spent
     * @param $timestamp //when they spent time on task
     */
    public function __construct($timeId, $duration, $description, $timestamp)
    {
        $this->timeId = $timeId;
        $this->duration = $duration;
        $this->description = $description;
        $this->timestamp = $timestamp;
    }

    public function getTimeId()
    {
        return $this->timeId;
    }

    public function getDuration()
    {
        return $this->duration;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function getTimestamp()
    {
        return $this->timestamp;
    }


}