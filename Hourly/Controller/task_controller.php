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

        if($modules){
            foreach($modules as $row)
            {
                echo "<option value='".$row['module_code']."'>".$row['module_code']." - ".$row['module_name']."</option>";
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

        if($tasks){
            foreach($tasks as $row){
                echo "<option value='".$row['task_id']."'>".$row['task_name']."(".$row['module_code'].")"."</option>";
            }
        }
    }

    //Get all ongoing tasks for one module
    public function getAllOngoingModuleTasks($moduleCode){
        $result= $this->database->getModuleOngoingTasks($this->username, $moduleCode);

        if($result){
            $allTasks = [];
            foreach($result as $row){
                $task = new Task($row['task_id'], $row['task_name'], $row['task_category'], $row['due_date'], $row['due_time'], $row['priority_level']);
                $allTasks[] = $task;
            }
        }

        return $allTasks;
    }

    //Sort tasks by their categories
    public function sortTasks($module){
        //Return array full of task objects
        $allTasks = $this->getAllOngoingModuleTasks($module);

        if($allTasks){
            foreach($allTasks as $task){
                //$this->appendToOngoing($task, $task->getTaskCategory());
                $taskName = $task->getTaskName();
                $jQuery = "";

                switch ($task->getTaskCategory()) {
                    case "General":
                        //echo "Your favorite color is red!";
                        $jQuery = "$('#generalTasks').append('<br><p>".$taskName."</p>');";
                        break;
                    case "Revision":
                        $jQuery = "$('#revisionTasks').append('<br><p>".$taskName."</p>');";
                        break;
                    default:
                        $jQuery = "$('#courseworkTasks').append('<br><p>".$taskName."</p>');";
                }

                echo $jQuery;
            }

        }
    }

    //Add CATEGORY tasks to CATEGORY section
    public function appendToOngoing($task, $category){
        $taskName = $task->getTaskName();
        $id = "#".$category;
        echo "<br>".$id;
        $jquery = "$(".$id.").append('<br><p>".$taskName."</p>');";
        echo $jquery;
    }





}