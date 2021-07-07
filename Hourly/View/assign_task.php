<?php include_once '../Controller/Task_Controller.php' ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script src="../JQuery/task_controller.js"></script>
    <script src="../JQuery/validating_input.js"></script>
    <style>
        #taskCategory, #moduleCode,  #moduleLabel{
            margin: 10px;
        }

        #categoryLabel, #taskCategory{margin-right:10px;}

        #categoryLabel{padding:10px;}

        .deadline{
            margin:10px;
        }

        .hidden{display: none;}
    </style>
</head>
<body>
    <div class="modal fade" id="taskModal" style='font-family: "Century Gothic", "Century", "Century Schoolbook"'>
        <div class="modal-dialog modal-dialog-centered modal-xl">
            <div class="modal-content">

                <div class="modal-header">
                    <h4 class="modal-title" style="font-family:'Century Gothic'">Assign a Task</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <div class="modal-body">
                    <div class="container" id="moduleContainer">
                        <form method="post" action="../Controller/taskController.php">



                        <!-- INPUT TASK NAME -->
                        <div class="form-group row">
                            <label for="taskName" class="col-form-label">Task Name: <p id="taskNameChars"></p></label>
                            <div class="col-10">
                                <input class="form-control userInput taskInput" type="text" name="taskName" id="taskName" maxlength="150">
                            </div>
                        </div>

                        <!-- ASSIGN TO MODULE -->
                        <div class="form-group row">
                            <div class="form-group row">

                                        <div class="col-2">
                                            <label for="moduleCode" id="moduleLabel" class="col-form-label">Assign to Module: <label>
                                        </div>
                                        <div class="col-6">
                                            <select class="form-control" name="moduleCode" id="moduleCode">
                                                <?php
                                                $controller = new Task_Controller("dummy");
                                                $controller->displayModuleChoices();
                                                ?>
                                            </select>
                                        </div>
                            </div>

                            <!-- CATEGORISE TASK -->
                            <div class="form-group row" id="categoryDiv">

                                    <div class="col-3">
                                        <label for="taskCategory" id="categoryLabel" class="col-form-label">Task Category: </label>
                                    </div>
                                    <div class="col-6">
                                        <select class="form-control" name="taskCategory" id="taskCategory">
                                            <option value="General">General</option>
                                            <option value="Revision">Revision</option>
                                            <option value="Coursework">Coursework</option>
                                        </select>
                                    </div>
                            </div>

                            <!-- ASSIGN A PRIORITY LEVEL (DEFAULT: LOW) -->
                            <div class="form-group row" id="priorityDiv">
                                <div class="col-3">
                                    <label class="col-form-label">Priority Level: <label>
                                </div>
                                <div class="col-6">
                                    <select class="form-control" name="priorityOptions" id="priorityOptions">
                                        <option value="Low">Low</option>
                                        <option value="Medium">Medium</option>
                                        <option value="High">High</option>
                                    </select>
                                </div>
                            </div>
                        </div>


                        <!-- OPTIONAL TO SET DEADLINE -->
                        <div class="form-group row">
                            <div class="col-form-2 deadline">
                                <label class="form-check-label">Deadline Date:</label>
                            </div>
                            <div class="col-form-4 deadline">
                                <input class="form-control" id="deadlineInput" name="deadlineInput" readonly>
                            </div>
                            <div class="col-form-2 deadline">
                                <button type="button" class="btn btn-info" data-toggle="modal" data-target="#setDateTimeModal">Set Deadline</button>
                            </div>
                            <div class="col-form-2 deadline">
                                <button type="button" class="btn btn-dark" id="dueAnytimeBtn">Due Anytime</button>
                            </div>
                        </div>

                            <p id="requiredMessageTask"></p>
                            <input type="submit" class="btn btn-primary" id="addTaskBtn" name="addTaskBtn" value="Create Task" disabled>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
<?php
include_once 'set_datetime.php' //POP UP PAGE TO CHANGE DEADLINE DATETIME
?>
</body>
</html>

<script>
    $(function(){
        //DEFAULT VALUE FOR DEADLINE INPUT = "Due Anytime"
        $("#deadlineInput").val("Due Anytime");

        //Transfer deadline date to input field once pop up page closes
        $("#confirmDateBtn").click(function(){
            let theDate = $("#theDate").val();
            let theTime = $("#theTime").val();

            $("#deadlineInput").val(theDate + " " + theTime);
        });

        //Change deadline to "due anytime"
        $("#dueAnytimeBtn").click(function(){
            $("#deadlineInput").val("Due Anytime");
        });

    });
</script>




