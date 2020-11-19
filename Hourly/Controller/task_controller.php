<?php
include_once '../Model/Database.php';
include_once '../Model/Task.php';

class task_controller
{
    private $database;
    private $username;

    /**
     * task_controller constructor.
     */
    public function __construct($user)
    {
        $this->username = $user;
        $this->database = new Database();
    }

    public function displayModuleChoices()
    {
        //Get all modules user has made
        $modules = $this->database->getModuleCodes($this->username);

        if ($modules) {
            foreach ($modules as $row) {
                echo "<option value='" . $row['module_code'] . "'>" . $row['module_code'] . " - " . $row['module_name'] . "</option>";
            }
        }
    }

    //Create a task and assign to a module
    public function assignTask($moduleCode, $taskName, $taskCategory, $dueDate, $dueTime, $priorityLevel)
    {
        $this->database->assignTask($moduleCode, $this->username, $taskName, $taskCategory, $dueDate, $dueTime, $priorityLevel);
    }

    //Display all ongoing tasks in a drop down menu for add time pop up page
    public function displayOngoingTasks()
    {
        $tasks = $this->database->getAllOngoingTasks($this->username);

        if ($tasks) {
            foreach ($tasks as $row) {
                echo "<option value='" . $row['task_id'] . "'>" . $row['task_name'] . "(" . $row['module_code'] . ")" . "</option>";
            }
        }
    }

    //Get all ongoing tasks for one module
    public function getAllOngoingModuleTasks($moduleCode)
    {
        $result = $this->database->getModuleOngoingTasks($this->username, $moduleCode);

        if ($result) {
            $allTasks = [];
            foreach ($result as $row) {
                $task = new Task($row['task_id'], $row['task_name'], $row['task_category'], $row['due_date'], $row['due_time'], $row['priority_level']);
                $allTasks[] = $task;
            }
        }

        return $allTasks;
    }

    //Sort tasks by their categories
    public function sortTasks($module)
    {
        //Return array full of task objects for a module
        $allTasks = $this->getAllOngoingModuleTasks($module);

        if ($allTasks) {
            foreach ($allTasks as $task) {
                $taskName = $task->getTaskName();
                //Format date
                $date = $this->formatDate($task->getDueDate(), $task->getDueTime());

                //Colour code priority
                $priority = $this->sortPriority($task->getPriorityLevel());

                //For marking a task complete
                $checkbox = ' <input class="complete" type="checkbox" value="'.$task->getTaskId().'" id="'.$task->getTaskId().'">';

                $jQuery = "";

                //Output task under a category box
                switch ($task->getTaskCategory()) {
                    case "General":
                        $jQuery = "$('#generalTasks').append('<br><label>" .$priority.'<button class="btn taskBtn" id="'.$task->getTaskId()
                            .'" data-toggle="modal" data-target="#viewTask">'.
                            $taskName.'</button>'.$checkbox.$date. "</label>');";
                        break;
                    case "Revision":
                        $jQuery = "$('#revisionTasks').append('<br><label>" .$priority.'<button class="btn taskBtn" id="'.$task->getTaskId()
                            .'" data-toggle="modal" data-target="#viewTask">'.
                            $taskName.'</button>'.$checkbox.$date. "</label>');";
                        break;
                    default:
                        $jQuery = "$('#courseworkTasks').append('<br><label>" .$priority.'<button class="btn taskBtn" id="'.$task->getTaskId()
                            .'" data-toggle="modal" data-target="#viewTask">'.
                            $taskName.'</button>'.$checkbox.$date. "</>');";
                }

                echo $jQuery;
            }

        }
    }

    //Display deadline date or state it is due anytime
    public function formatDate($date, $time){
        $d = date("Y", strtotime($date));
        $icon = '<i class="far fa-calendar-alt"></i>'; //Calender icon

        if($d == "9999"){
            $due = "<br>".$icon." Anytime";
        }else
        {
            $due = "<br> ".$icon." ".date("d/m h:m", strtotime($date." ".$time));
        }

        return $due;
    }

    //Colour code priority level
    public function sortPriority($priority)
    {
        $colour = '';
        switch ($priority) {
            case "Low":
                $colour = 'green';
                break;
            case "Medium":
                $colour = 'orange';
                break;
            default:
                $colour = 'red';

        }
        return $style = '<i style="color:'.$colour.'" class="fas fa-exclamation"></i> ';
    }

    //Return details of a task
    public function getTaskDetails($task_id){
        $result = $this->database->getTaskDetails($task_id);
        if($result){
            foreach($result as $row){
                $task = new Task($task_id, $row['task_name'], $row['task_category'], $row['due_date'], $row['due_time'], $row['priority_level']);
            }
        }
        return $task;
    }

    public function completeTask($taskId){
        $this->database->completeTask($this->username, $taskId);
    }



}