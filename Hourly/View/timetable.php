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
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
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
<?php include_once 'view_class.php';?> <!-- IMPORT POP-UP PAGE TO VIEW FURTHER CLASS DETAILS -->
</body>
</html>


