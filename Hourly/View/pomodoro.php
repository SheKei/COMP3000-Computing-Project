<?php
include_once '../Controller/Task_Controller.php';
$taskController = new Task_Controller('dummy');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Pomodoro Timer</title>

    <style>
        #homePanel{
            margin-left: 25%;
            margin-top: 5%;
        }

        #inputPanel, #timePanel{
            border-radius: 25px;
            border: 2px solid black;
            padding: 20px;
        }

        #inputPanel{
            width: 95%;
            height: 600px;
            background-color: white;
        }

        #timePanel{
            width: 400px;
            height: 200px;
            margin-right: auto;
            margin-left: auto;
        }

        .text-center{
            font-family: "Century Gothic", "Century", "Century Schoolbook";
            letter-spacing: 3px;
        }
         label,button{
             font-family: "Century Gothic", "Century", "Century Schoolbook";
         }

         #taskSelection, .col-form-label, .col-auto{
             margin-left: auto;
             margin-right: auto;
         }
    </style>

</head>
<body style="background-color: rgb(255, 253, 250);">

<?php
include_once "../Public/top_navbar.php";
include_once "../Public/side_navbar.php";
?>

<div id="homePanel">
    <br>
    <div id="inputPanel">
        <h2 class="text-center">Pomodoro</h2>


        <div class="form-group row" id="taskSelection">
            <label for="taskName" class="col-form-label">Task: <label>
                    <div class="col-auto">
                        <select class="form-control" name="taskName" id="taskName">
                            <?php
                            $controller = new Task_Controller('dummy');
                            $controller->displayOngoingTasks();
                            ?>
                        </select>
                    </div>
        </div>

        <div id="buttons" class="text-center">

            <p>
                <button class="btn btn-dark time" id="decrement"><i class="fas fa-minus-circle"></i></button>
                <span id="timeChosen">25</span><span> minutes </span>
                <button class="btn btn-dark time" id="increment"><i class="fas fa-plus-circle"></i></button>
            </p>

        </div>

        <div id="timePanel">
            <p id="timer"></p>
        </div>



    </div>
</div>


</body>
</html>

<script>
    $(function(){
        //If user clicks on a time button
        $(".time").click(function(){
            let theId =  event.target.id;
            //Get current minutes
            let currentMinutes = Number($("#timeChosen").html());

            //Check if increment or decrement button
            if(theId === "increment"){
                currentMinutes = currentMinutes + 5;
            }else{
                if(currentMinutes > 0){
                    currentMinutes = currentMinutes - 5;
                }else{
                    currentMinutes = 0;
                }

            }

            //Display change in minutes
            $("#timer").html(currentMinutes);
            $("#timeChosen").html(currentMinutes);

        });

    });
</script>
