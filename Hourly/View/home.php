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

    <style>
        #homePanel{
            margin-left: 25%;
            margin-top: 8%;

        }

        .panel{
            background-color: white;
            border-radius: 25px;
            border: 2px solid black;
            padding: 20px;
        }

        #classPanel{
            width: 95%;
            min-height: 200px;
        }

        #reminders, #upcomingDeadlines{
            min-height: 350px;
            margin-top: 25px;
        }


        #reminders{
            margin-left:10%;
            width: 30%;
        }

        #upcomingDeadlines{
            margin-left: 2%;
            width: 50%;
        }

        .logAttendance{
            margin-left:10px;
        }

        #classTitle{
            letter-spacing: 3px;
        }

        .title{
            font-family: "Century Gothic", "Century", "Century Schoolbook";
            letter-spacing: 3px;
        }

        body{background-color: rgb(255, 253, 247);}
    </style>

</head>
<body style="font-family: 'Century Gothic'; background-color: rgb(255, 253, 250);">

<?php
    include_once "../Public/top_navbar.php";
include_once "../Public/side_navbar.php";
?>

<div id="homePanel">

    <div class="panel" id="classPanel">
        <?php $classController->showTodaysClasses(); ?>
    </div>

    <div class="row">
        <div class="panel" id="upcomingDeadlines">
            <h3 class="title">Upcoming Deadlines</h3>
        </div>

        <div class="panel" id="reminders">
            <h3 class="title">Reminders</h3>
        </div>
    </div>
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

        //If user logs attendance for a class
        $(".logAttendance").click(function(){
            //Get the id of the class attended
            let theId = event.target.id;
            window.location.href = "../Controller/classController.php?attendanceClassId="+theId;
        });
    });
</script>
