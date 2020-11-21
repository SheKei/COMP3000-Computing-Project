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
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="../JQuery/complete_task.js"></script>
    <script src="../JQuery/add_module.js"></script>
    <script src="../JQuery/validating_input.js"></script>
    <style>
        #heading, #buttonDisplay{
            margin-left: 20%;
        }
        #moduleCodeCurrent{display:none;}
    </style>
</head>
<body>
    <?php include_once'view_module.php'; ?> <!--IMPORT HTML POP-UP PAGE FOR VIEWING MODULE DETAILS -->

    <?php include_once 'ongoing_tasks.php';?> <!--IMPORT HTML TO VIEW ONGOING TASKS-->
    <script>
        $(function(){
            <?php $taskControl->sortTasks($_GET['code']); ?>
        });
    </script>

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

                //Send task id to retrieve details
                xmlhttp.open("GET","../Controller/taskController.php?taskId="+theId,true);
                xmlhttp.send();
            }
        });
    });
</script>