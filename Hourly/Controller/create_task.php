<?php
include_once 'task_controller.php';
include_once 'time_controller.php';

//Replace with session
$controller = new task_controller("dummy");
$timeController = new time_controller('dummy');

if(isset($_POST['addTaskBtn'])){

    $task_name = $_POST['taskName'];
    $module_code = $_POST['moduleCode'];
    $task_category = $_POST['taskCategory'];
    $priority = $_POST['priorityOptions'];

    //Check if user set a deadline
    if($_POST['dueDeadline'] == "dueAnytime"){
        $due_date = "9999-12-30"; //Set to an extreme date if no deadline
        $due_time = "";
    }
    else
    {
        $due_date = $_POST['dueDate'];
        $due_time = $_POST['dueTime'];
    }

    $controller->assignTask($module_code, $task_name, $task_category, $due_date, $due_time, $priority);

    //Go to module page once created
    header('Location: ../View/module.php?code='.$module_code);
}

//GET request to mark task complete
if(isset($_GET['task'])){
    $controller->completeTask($_GET['task']);
    header('Location: ../View/home.php');
}

//GET request to delete task
if(isset($_GET['delTaskId'])){
    $controller->deleteTask($_GET['delTaskId']);
    header('Location: ../View/home.php');
}

//GET request to view task details on a pop-up page
if(isset($_GET['taskId'])){

    $task = $controller->getTaskDetails($_GET['taskId']);

    if($task){

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
         <label for="moduleCode" id="moduleLabel" class="col-form-label">Assign to Module: <label>
         <div class="col-auto">
         <select class="form-control" name="moduleCode" id="moduleCode">';
         echo '<option value="'.$task->getTaskCategory().'">'.'COMP3000'.'</option>';
         $controller->displayModuleChoices();
         echo '</select></div></div>';

         echo //TASK CATEGORY
         '<div class="form-group row">
          <label for="taskCategory" id="categoryLabel" class="col-form-label">Task Category: <label>
          <div class="col-auto">
          <select class="form-control" name="taskCategory" id="taskCategory">';
          echo '<option value="'.$task->getTaskCategory().'">'.$task->getTaskCategory().'</option>';
          echo '<option value="General">General</option>
          <option value="Revision">Revision</option>
          <option value="Coursework">Coursework</option>
          </select>
          </div></div>';

          echo //PRIORITY LEVEL
          '<div class="form-group row">
          <label for="priorityLevel" class="col-form-label">Priority Level: <label>
          <div class="col-auto">
          <select class="form-control" name="priorityLevel" id="priorityLevel">';
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
              echo '<p>Due Anytime</p>';
          }else{
              echo '<p>'.$task->getDueDate().' - '.$task->getDueTime().'</p>';
          }
          echo '</div>';

          echo //DELETE TASK BTN
          '<button class="btn deleteTask" id="'.$task->getTaskId().'">Delete Task</button>';

          echo '<script>
                $(".deleteTask").click(function(){
                    let delTaskId = this.id; //Get id of task
                    window.location.href = "../Controller/create_task.php?delTaskId="+delTaskId; //Send to controller 
                });
                </script>';
    }

    //GET TIME SPENT ON SELECTED TASK
    $timeController->outputTimes($timeController->getTaskTime($_GET['taskId']));
}