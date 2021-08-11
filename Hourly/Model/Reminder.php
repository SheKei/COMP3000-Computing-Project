<?php


class Reminder
{
    protected $reminderID;
    protected $description;
    protected $datestamp;

    /**
     * Reminder constructor.
     * @param $reminderID
     * @param $description - Content of reminder
     */
    public function __construct($reminderID, $description, $datestamp)
    {
        $this->reminderID = $reminderID;
        $this->description = $description;
        $this->datestamp = $datestamp;
    }

    public function getReminderID()
    {
        return $this->reminderID;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function getDatestamp(){
        return $this->datestamp;
    }
}