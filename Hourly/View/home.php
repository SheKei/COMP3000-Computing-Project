<?php
include_once'../Controller/Class_Controller.php';
$classController = new Class_Controller('dummy');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Home</title>


</head>
<body>

<?php
    include_once "../Public/top_navbar.php";
include_once "../Public/side_navbar.php";
?>

<div id="issuePara" style="margin-left: 25%;">
    <br><br><br><br>
    <h3>Issues found & yet to be fixed (as of 19/11/20):</h3>
    <ul>
        <li>Entering the same module code will bring an error in add module</li>
        <li>The overall appearance </li>
    </ul>
    <?php $classController->showTodaysClasses(); ?>
</div>

<?php include_once'view_class.php'; ?>


</body>
</html>

<script>
    $(function(){
        //If user clicks on a task
        $(".viewClassBtn").click(function(){

            //Get the id of the task being viewed
            let theId = event.target.id;

            if(theId!=""){
                let xmlhttp = new XMLHttpRequest();
                //Wait for response
                xmlhttp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                        $("#classDetails").html(this.responseText); //Output details of clicked class
                    }
                }

                //Send class id to retrieve details
                xmlhttp.open("GET","../Controller/classController.php?classId="+theId,true);
                xmlhttp.send();
            }
        });
    });
</script>
