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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <style>
        #timetable{
            margin-left: 25%;
            margin-top: 10%;
        }

        .classes{
            margin-left: 20px;
        }
    </style>
</head>
<body>

<?php
include_once '../Public/top_navbar.php';
include_once '../Public/side_navbar.php';
?>

<div id="timetable" >
    <h1>Timetable</h1><br>
    <?php $classController->displayModuleSections(); ?>
    <script>
        $(function(){
            <?php $classController->sortTimetableClasses(); ?>
        });
    </script>
</div>

</body>
</html>


