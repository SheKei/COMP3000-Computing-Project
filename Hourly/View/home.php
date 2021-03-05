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
            margin-top: 10%;
            border-radius: 25px;
            border: 2px solid black;
            padding: 20px;
            width: 70%;
            min-height: 200px;
        }

        .logAttendance{
            margin-left:10px;
        }

        #classTitle{
            letter-spacing: 3px;
        }
    </style>

</head>
<body style="font-family: 'Century Gothic'">

<?php
    include_once "../Public/top_navbar.php";
include_once "../Public/side_navbar.php";
?>

<div id="homePanel">
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

        //If user logs attendance for a class
        $(".logAttendance").click(function(){
            //Get the id of the class attended
            let theId = event.target.id;
            window.location.href = "../Controller/classController.php?attendanceClassId="+theId;
        });
    });
</script>
