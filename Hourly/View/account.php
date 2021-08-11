<?php
include_once '../Controller/Account_Controller.php';
include_once '../Controller/Goal_Controller.php';
include_once '../Controller/Deadline_Controller.php';
$goalController = new Goal_Controller('dummy');
$deadlineController = new Deadline_Controller('dummy');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Account</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>

    <style>
        #overallContainer{
            margin-left: 25%;
            margin-top: 10%;
        }

        h3,p,div.panel{
            font-family: "Century Gothic", "Century", "Century Schoolbook";
        }

        p{font-size: 20px;}

        .panel{
            background-color: white;
            border-radius: 25px;
            border: 2px solid black;
            padding: 20px;
            margin: 25px;
        }

        .row{
            margin: 1%;
        }


    </style>
</head>
<body>
<?php
include_once '../Public/top_navbar.php';
include_once '../Public/side_navbar.php';
?>

<div id="overallContainer">

    <div class="row">
        <div class="col-lg-10 panel" id="accountContainer">
            <?php
            $accountController = new Account_Controller("dummy");
            $accountController->displayAccountDetails();
            ?>
        </div>
    </div>


    <div class="row">
        <div class="col-lg-4 panel" id="goalContainer">
            <h3>Number of hours to achieve per... </h3><br>
            <?php $goalController->displayGoals(); ?>
        </div>

        <div class="col-lg-6 panel" id="deadlineContainer">
             <h3>Adjust the Deadline Period</h3><br><br>
             <?php $deadlineController->getDeadlinePeriod(); ?>
        </div>
    </div>
</div>
</body>
</html>
