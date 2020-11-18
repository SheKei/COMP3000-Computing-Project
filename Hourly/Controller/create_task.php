<?php
include_once 'task_controller.php';

if(isset($_POST['addTaskBtn'])){

    $task_name = $_POST['taskName'];
    $module_code = $_POST['moduleCode'];
    $task_category = $_POST['taskCategory'];
    $priority = $_POST['priorityOptions'];

    if($_POST['dueDeadline'] == "dueAnytime"){
        $due_date = "9999-12-30"; //Set to an extreme date
        $due_time = "";
    }
    else
    {
        $due_date = $_POST['dueDate'];
        $due_time = $_POST['dueTime'];
    }


    //Replace with session
    $controller = new task_controller("dummy");
    $controller->assignTask($module_code, $task_name, $task_category, $due_date, $due_time, $priority);

    //Go to module page once created
    header('Location: ../View/module.php?code='.$module_code);


}

//User marks a task complete
if(isset($_GET['task'])){
    $controller = new task_controller('dummy');
    $controller->completeTask($_GET['task']);
    header('Location: ../View/home.php');
}

//User views task details
if(isset($_GET['taskId'])){
    $controller = new task_controller('dummy');
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


    }
}