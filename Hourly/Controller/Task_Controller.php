<?php
include_once '../Model/Database.php';
include_once '../Model/Task.php';
include_once '../Controller/Time_Controller.php';

class Task_Controller
{
    protected $database;
    protected $username;

    /**
     * Task_Controller constructor.
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

    public function editTask($taskId,$moduleCode, $taskName, $taskCategory, $dueDate, $dueTime, $priorityLevel){
        $this->database->editTask($taskId,$moduleCode, $taskName, $taskCategory, $dueDate, $dueTime, $priorityLevel);
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
                $checkbox = '<button type="button" class="complete btn btn-success" id="'.$task->getTaskId().'"><i class="far fa-check-square"></i></button>';
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

    //Return details of a task and pass on the page name from where it was requested
    public function getTaskDetails($task_id, $theLocation){
        $result = $this->database->getTaskDetails($task_id);
        if($result){
            foreach($result as $row){
                $task = new Task($task_id, $row['task_name'], $row['task_category'], $row['due_date'], $row['due_time'], $row['priority_level']);
            }
        }
        $this->displayTaskDetails($task, $theLocation);
    }


    //Update task status from Ongoing to Completed
    public function completeTask($taskId){
        $this->database->completeTask($this->username, $taskId);
    }

    //Delete a task and time spent on it
    public function deleteTask($taskId){
        $this->database->archiveTask($taskId);
        $this->database->deleteTask($taskId);
    }

    //Display names of completed tasks and categorise them
    public function displayCompletedTasks($module){
        $results = $this->database->getModuleCompletedTasks($this->username,$module);
        if($results){
            foreach($results as $row){
                $taskName = $row['task_name'];

                $jQuery = "";

                //Output task under a category box
                switch ($row['task_category']) {
                    case "General":
                        $jQuery = '$("#completedGeneralTasks").append("<br><label><button class=\"btn taskBtn completed\" id=\"'.$row['task_id']
                            .'\" data-toggle=\"modal\" data-target=\"#viewTask\">'.
                            $taskName.'</button></label>");';
                        break;
                    case "Revision": //#completedRevisionTasks
                        $jQuery = '$("#completedRevisionTasks").append("<br><label><button class=\"btn taskBtn completed\" id=\"'.$row['task_id']
                            .'\" data-toggle=\"modal\" data-target=\"#viewTask\">'.
                            $taskName.'</button></label>");';
                        break;
                    default: //#completedCourseworkTasks
                        $jQuery = '$("#completedCourseworkTasks").append("<br><label><button class=\"btn taskBtn completed\" id=\"'.$row['task_id']
                            .'\" data-toggle=\"modal\" data-target=\"#viewTask\">'.
                            $taskName.'</button></label>");';
                }

                echo $jQuery;
            }
        }
    }

    //Display details of a task on a pop-up page when a task name is clicked on
    public function displayTaskDetails($task, $location){
        if($task){
            echo '<form method="post" action="../Controller/taskController.php">';

            echo '<input type="text" class="form-control hidden" name="id" value="'.$task->getTaskId().'" readonly>'; //TASK ID
            echo //TASK NAME
                '<div class="form-group row">
         <label for="tName" class="col-form-label">Task Name: <p id="tNameChars"></p></label>
         <div class="col-10">
         <input class="form-control userInput taskInput" type="text" name="tName" id="tName" maxlength="150" value="'.$task->getTaskName().'">
         </div>
         </div>';

            echo //MODULE ASSIGNMENT
            '<div class="form-row">
         <div class="form-group row">
         <label for="module" id="moduleLabel" class="col-form-label">Assign to Module: <label>
         <div class="col-auto">
         <select class="form-control" name="module" id="module">';
            $this->displayModuleChoices();
            echo '</select></div></div>';

            echo //TASK CATEGORY
            '<div class="form-group row">
          <label for="category" id="categoryLabel" class="col-form-label">Task Category: <label>
          <div class="col-auto">
          <select class="form-control" name="category" id="category">';
            echo '<option value="'.$task->getTaskCategory().'">'.$task->getTaskCategory().'</option>';
            echo '<option value="General">General</option>
          <option value="Revision">Revision</option>
          <option value="Coursework">Coursework</option>
          </select>
          </div></div>';

            echo //PRIORITY LEVEL
            '<div class="form-group row">
          <label for="priority" class="col-form-label">Priority Level: <label>
          <div class="col-auto">
          <select class="form-control" name="priority" id="priority">';
            echo '<option value="'.$task->getPriorityLevel().'">'.$task->getPriorityLevel().'</option>';
            echo
            '<option value="Low">Low</option>
          <option value="Medium">Medium</option>
          <option value="High">High</option>
          </select>
          </div></div></div>';

            echo //DEADLINE
            ' <div class="form-group row">
              <label class="col-form-label">Due Deadline: <label>';

            //CHECK IF DUE ANYTIME
            $d = date("Y", strtotime($task->getDueDate()));
            if($d == "9999")
            {
                $due = 'Due Anytime';
            }else{
                $due = $task->getDueDate().' - '.$task->getDueTime();
            }
            echo '<div class="row">';

            //Change id of date field and pop up page depending on from current web page
            if($location == "Module Page"){
                $fieldId = "currentDue";
                $popUp = "changeDateTimeModal";
            }else{
                $fieldId = "currentDate";
                $popUp = "changeDateTimeModalFromHome";
            }
            echo'<div class="col"><input id="'.$fieldId.'" name="currentDue" type="text" size="50" class="currentDue form-control" value="'.$due.'" readonly></div>';
            echo '<div class="col"><button type="button" class="btn btn-info" id="changeDeadline" data-toggle="modal" data-target="#'.$popUp.'">Edit Deadline</button></div>';
            echo '</div>';
            echo '</div>';

            echo '<div style="margin-left: 60%" class="row"><button type="submit" class="btn btn-dark" id="editTaskBtn" name="editTaskBtn">Update Task</button></form>';
            echo //DELETE TASK BTN
                '<button style="margin-left:20px;" type="button" class="btn btn-danger deleteTask" id="'.$task->getTaskId().'">Delete Task</button>';
            echo //COMPLETE TASK BTN
                '<button style="margin-left:20px;" type="button" class="btn btn-success completeTask" id="'.$task->getTaskId().'">Complete Task</button></div><br><br>';

            //JQUERY EVENTS RELATED TO DYNAMIC FIELDS ABOVE
            echo '<script>
                //BTN to delete task
                $(".deleteTask").click(function(){
                    let delTaskId = this.id; //Get id of task
                    window.location.href = "../Controller/taskController.php?delTaskId="+delTaskId; //Send to controller 
                });
                
                //BTN to change task status to complete
                $(".completeTask").click(function(){
                    let completeTaskId = this.id; //Get id of task
                    window.location.href = "../Controller/taskController.php?completeTaskId="+completeTaskId; //Send to controller 
                });
                
                </script>';
        }
    }

    public function displayCompletedTaskDetails($taskId){
        $result = $this->database->getTaskDetails($taskId);
        if($result){
            foreach($result as $row){
                echo '<p><strong>Task Name:</strong>'.$row['task_name'].'</p>';
                echo '<p><strong>Category:</strong>'.$row['task_category'];

                //CHECK IF DUE ANYTIME
                $d = date("Y", strtotime($row['due_date']));
                if($d == "9999")
                {
                    $due = 'Due Anytime';
                }else{
                    $due = $row['due_date'].' - '.$row['due_time'];
                }

                echo '<p><strong>Deadline:</strong>'.$due.'</p>';
                echo '<p><strong>Priority Level:</strong>'.$row['priority_level'].'</p>';

                echo '<button class="btn btn-danger deleteTask" id="'.$taskId.'">Delete Task</button>';

                echo '<script>
                $(".deleteTask").click(function(){
                    let delTaskId = this.id; //Get id of task
                    window.location.href = "../Controller/taskController.php?delTaskId="+delTaskId; //Send to controller 
                });
                
                </script>';
            }
        }
    }


}