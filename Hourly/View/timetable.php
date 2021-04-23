<?php
include_once '../Controller/Class_Controller.php';
$classController = new Class_Controller('dummy');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Timetable</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://kit.fontawesome.com/20c7401107.js" crossorigin="anonymous"></script>
    <style>
        #timetable{
            margin-left: 25%;
            margin-top: 10%;
        }

        .classes{
            margin-left: 20px;
        }

        .hidden{
            display: none;
        }

        .classes, .moduleTitle{
            font-family: "Century Gothic", "Century", "Century Schoolbook";
        }

        .moduleTitle,h1{letter-spacing: 2px;}

    </style>
</head>
<body>

<?php
include_once '../Public/top_navbar.php';
include_once '../Public/side_navbar.php';
?>

<div id="timetable" >
    <h1 style="font-family: 'Century Gothic';letter-spacing: 2px;font-size: 35px;">Timetable</h1><br>
    <?php $classController->displayModuleSections(); ?>
    <script>
        $(function(){
            <?php $classController->sortTimetableClasses(); ?>
        });
    </script>
</div>
<?php include_once 'view_class.php';?> <!-- IMPORT POP-UP PAGE TO VIEW FURTHER CLASS DETAILS -->
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


