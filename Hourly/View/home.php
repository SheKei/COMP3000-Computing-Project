<?php //IMPORT CONTROLLERS
include_once'../Controller/Class_Controller.php';
include_once '../Controller/Reminder_Controller.php';
include_once '../Controller/Deadline_Controller.php';
include_once '../Controller/Goal_Controller.php';
include_once '../Controller/Notification_Controller.php';

include_once '../View/view_task.php'; //POP UP PAGE TO VIEW DEADLINE DETAILS

$classController = new Class_Controller('dummy');
$reminderController = new Reminder_Controller('dummy');
$deadlineController = new Deadline_Controller('dummy');
$goalController = new Goal_Controller('dummy');
$notificationController = new Notification_Controller();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://kit.fontawesome.com/20c7401107.js" crossorigin="anonymous"></script>
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
            margin: 15px;
        }

        #reminders, #upcomingDeadlines{
            min-height: 350px;
            margin-top: 25px;
        }


        #reminders,#upcomingDeadlines{
            min-height: 300px;
            margin:1%;
        }



        .logAttendance{
            margin-left:10px;
        }

        #classTitle{
            letter-spacing: 3px;
        }

        .title, h4,h5{
            font-family: "Century Gothic", "Century", "Century Schoolbook";
        }

        .title{
            letter-spacing: 3px;
        }

        body{background-color: rgb(255, 253, 247);}

        i.fa-times-circle:hover{
            color: #FF5C4D;
        }

        .fa-times-circle{
            margin-right: 10px;
        }

        .upcomingDeadline{
            font-size: 20px;
        }

        .theReminder:hover{
            cursor: pointer;
            color: darkgrey;
        }

        #addReminderBtn:hover{
            background-color: mediumseagreen;
        }

        #classPanel{
            min-height:250px;
        }

        .due, .taskBtn{
            font-size: 20px;
        }

    </style>

</head>
<body style="font-family: 'Century Gothic'; background-color: rgb(255, 253, 250);">

<?php
    include_once "../Public/top_navbar.php";
include_once "../Public/side_navbar.php";
?>

<div id="homePanel">

    <?php //NOTIFICATION DISPLAY HERE
        if(isset($_GET['deleteReminder'])){
            $notificationController->displayReminderDeletionNotification($_GET['deleteReminder']); //Notify user if deletion successful
        }
    ?>


    <div class="row">
        <div class="panel col-lg-7" id="classPanel">
            <section><h1 class='title' id='classTitle'>Today's Classes</h1></section><br>
            <?php $classController->showTodaysClasses(); //SHOW TODAY CLASSES TO ATTEND ?>
        </div>
        <div class="panel col-lg-4" id="goalPanel">
            <?php $goalController->displayOverallHours(); //DISPLAY HOURS WORKED THIS WEEK ?>
        </div>
    </div>


    <div class="row">
        <div class="col-lg-7 panel" id="upcomingDeadlines">
            <h3 class="title">Upcoming Deadlines</h3><br>
            <?php
                $deadlineController->displayDeadlines(); //DISPLAY UPCOMING DEADLINES
                include_once 'edit_deadline_from_home.php'; //SLOT POP-UP PAGE TO EDIT DEADLINES FROM HOME PAGE
            ?>
        </div>

        <div class=" col-lg-4 panel" id="reminders">
            <h3 class="title">
                <button id="addReminderBtn" class="btn btn-dark" data-toggle="modal" data-target="#reminderModal">
                    <i class="far fa-plus-square"></i>
                </button>
                Reminders
            </h3>
            <?php $reminderController->displayReminders(); //DISPLAY REMINDERS WRITTEN ?>
        </div>
    </div>
</div>

<?php
include_once'view_class.php';     //POP UP PAGE TO DISPLAY CLASS DETAILS ON TO FOR VIEWING
include_once 'add_reminder.php';  //POP UP PAGE TO ADD A REMINDER;
include_once 'edit_reminder.php'; //POP UP PAGE TO EDIT A REMINDER;
?>
<br><br>
</body>
</html>

<script>
    $(function(){
        //If user clicks on a class name to view details
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
            let theId = event.target.id;//Get the id of the class attended
            window.location.href = "../Controller/classController.php?attendanceClassId="+theId; //log attendance
        });

        //If user wants to delete a reminder
        $(".fa-times-circle").click(function(){
            let theId = event.target.id; //Get the id of the reminder
            window.location.href = "../Controller/reminderController.php?reminderID="+theId; //Delete reminder
        });

        //If user clicks on a deadline to view further details
        $(".taskBtn").click(function(){

            //Get the id of the task being viewed
            let theId = event.target.id;

            if(theId!=""){
                let xmlhttp2 = new XMLHttpRequest();
                //Wait for response
                xmlhttp2.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                        $("#details").html(this.responseText); //Output details of clicked task
                    }
                }

                xmlhttp2.open("GET","../Controller/taskController.php?taskIdHome="+theId,true);
                xmlhttp2.send();
            }
        });

        //Confirm deadline change btn pressed
        $(".theReminder").click(function(){
            let reminderID = event.target.id;//Get the id of clicked reminder
            reminderID = reminderID.slice(2,reminderID.length); //Remove the string 'id' to get just the number for the actual id of the reminder E.G. id2 --> 2
            if(reminderID!=""){
                let xmlhttp3 = new XMLHttpRequest();
                //Wait for response
                xmlhttp3.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                        $("#editReminderForm").html(this.responseText); //Output details of clicked reminder
                    }
                }

                xmlhttp3.open("GET","../Controller/reminderController.php?editReminderID="+reminderID,true);
                xmlhttp3.send();
            }
        });

        //Confirm deadline change btn pressed
        $("#confBtn").click(function(){
            let theDate = $("#theDateInput").val();
            let theTime = $("#theTimeInput").val();
            $("#currentDate").val(theDate + " " + theTime) //Change field to new deadline
        });

        //Remove a deadline btn clicked
        $("#removeBtn").click(function(){
            $("#currentDate").val("Due Anytime");
        });

    });
</script>

