<?php


class Reminder
{
    protected $reminderID;
    protected $description;

    /**
     * Reminder constructor.
     * @param $reminderID
     * @param $description - Content of reminder
     */
    public function __construct($reminderID, $description)
    {
        $this->reminderID = $reminderID;
        $this->description = $description;
    }

    public function getReminderID()
    {
        return $this->reminderID;
    }

    public function getDescription()
    {
        return $this->description;
    }

}