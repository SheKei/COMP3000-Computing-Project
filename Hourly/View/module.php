<?php
include_once '../Controller/Task_Controller.php';
include_once 'view_task.php'; //Pop-up page for viewing task details
$taskControl = new Task_Controller('dummy');

if(isset($_GET['code']))
{
    include_once '../Public/top_navbar.php';
    include_once '../Public/side_navbar.php';

}else{
    header('Location: home.php');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <script src="https://kit.fontawesome.com/20c7401107.js" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="../JQuery/complete_task.js"></script>
    <script src="../JQuery/module_controller.js"></script>
    <script src="../JQuery/validating_input.js"></script>

    <style>
        #buttonDisplay{
            margin-left: 20%;
        }
        #moduleCodeCurrent{display:none;}

        #ongoingBtn, #completedBtn{font-size: 20px;}

        #modulePanel{
            margin-left: 20%;
            margin-top: 5%;
        }
        body{background-color: rgb(255, 253, 247);}

        .hidden{
            display: none;
        }

    </style>
</head>
<body style="font-family: 'Century Gothic'">

    <div id="modulePanel">
        <?php include_once'view_module.php'; ?> <!--IMPORT HTML POP-UP PAGE FOR VIEWING MODULE DETAILS -->

        <!--TOGGLE VIEWING BETWEEN ONGOING OR COMPLETED TASKS-->
        <div class="text-center">
            <button type="button" class="btn btn-dark" id="ongoingBtn">View Ongoing</button>
            <button type="button" class="btn btn-dark" id="completedBtn">View Completed</button>
        </div><br>

        <!--IMPORT HTML TO VIEW ONGOING TASKS-->
            <div id="ongoingTasksDiv" class="w3-animate-zoom">
                <?php include_once 'ongoing_tasks.php';?>
                <script>
                    $(function(){
                        <?php $taskControl->sortTasks($_GET['code']); ?>
                    });
                </script>
            </div>
        <!-- IMPORT HTML TO VIEW COMPLETED TASKS -->
        <div id="completedTasksDiv" class="hidden w3-animate-zoom">
            <?php include_once 'completed_tasks.php'; ?>
            <script>
                $(function(){
                    <?php $taskControl->displayCompletedTasks($_GET['code']); ?>
                });
            </script>
        </div>

    </div>

    <script src="../JQuery/complete_task.js"></script><!--IMPORT JQUERY TO MARK A TASK COMPLETE-->

</body>
</html>

<!-- UNABLE TO PLACE SCRIPT INTO A SEPARATE FILE TO RUN -->
<script>
    $(function(){
        //If user clicks on a task
        $(".taskBtn").click(function(){

            //Get the id of the task being viewed
            let theId = event.target.id;

            if(theId!=""){
                let xmlhttp = new XMLHttpRequest();
                //Wait for response
                xmlhttp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                        $("#details").html(this.responseText); //Output details of clicked task
                    }
                }

                //DATA FORMAT DISPLAY CHANGES IF TASK IS COMPLETED OR ONGOING
                if($("#"+theId).hasClass("completed")){
                    xmlhttp.open("GET","../Controller/taskController.php?completedTaskId="+theId,true);
                    xmlhttp.send();
                }
                else{
                    xmlhttp.open("GET","../Controller/taskController.php?taskId="+theId,true);
                    xmlhttp.send();
                }
            }
        });

        //TOGGLE VIEWING BETWEEN COMPLETED OR ONGOING TASKS
        $("#ongoingBtn").click(function(){
            $("#ongoingTasksDiv").removeClass("hidden");
            $("#completedTasksDiv").addClass("hidden");
            adjustBtnDisplay("#ongoingBtn", "#completedBtn");
        });

        $("#completedBtn").click(function(){
            $("#completedTasksDiv").removeClass("hidden");
            $("#ongoingTasksDiv").addClass("hidden");
            adjustBtnDisplay("#completedBtn", "#ongoingBtn");
        });

        //Adjust button appearance to signal which one was clicked
        function adjustBtnDisplay(btn1, btn2){
            $(btn1).addClass("btn-secondary");
            $(btn1).removeClass("btn-dark");
            $(btn2).addClass("btn-dark");
            $(btn2).removeClass("btn-secondary");
        }
    });
</script>