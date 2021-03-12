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

         #timer{
             font-size: 50px;
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
            <p class="text-center" id="timer"></p>
            <div id="btnPanel" class="text-center">
                <button class="btn btn-success" id="button">Start</button>
                <button class="btn btn-dark" id="reset">Reset</button>
            </div>

        </div>



    </div>
</div>


</body>
</html>

<script>
    $(function(){
        var totalMinutes = 25;
        var remainingTime = totalMinutes * 60;
        $("#timer").html(calculateTime(remainingTime));

        var onPause = true;


        //Increment time by 5
        $("#increment").click(function(){
            remainingTime = Number($("#timeChosen").html()); //Get current minutes
            remainingTime = remainingTime + 5; //Increment current minutes by 5
            displayTime(); //Display change in time
        });

        //Check and decrement current time by 5
        $("#decrement").click(function(){
            remainingTime = Number($("#timeChosen").html());
            if(remainingTime > 5){
                remainingTime = remainingTime - 5; //Decrement current if minutes more than 5
            }else{
                remainingTime = 5;
            }
            displayTime(); //Display change in time
        });

        //When pomodoro start/pause btn is pressed
        $("#button").click(function(){

            if($("#button").hasClass("btn-success")){
                changeToPauseBtn();
            }else{
                changeToStartBtn();
            }
        });

        //Reset timer back to 25 minutes
        $("#reset").click(function(){
            $("#timer").html(calculateTime(25*60));
            $("#timeChosen").html(25);
        });

        function startTimer(remainingTime){

        }

        function displayTime(){
            //Display mm:ss in timer
            $("#timer").html(calculateTime(remainingTime*60));
            //Display current chosen time
            $("#timeChosen").html(remainingTime);
        }

    });

    //Format time into mm:ss
    function calculateTime(time){
        let quotient = parseInt(time/60);
        let remainder = time%60;

        if(remainder < 10){
            remainder = "0" + remainder;
        }
        return quotient + ":" + remainder;
    }

    function changeToStartBtn(){
        $("#button").removeClass("btn-danger");
        $("#button").addClass("btn-success");
        $("#button").html("Start");
    }

    function changeToPauseBtn(){
        $("#button").removeClass("btn-success");
        $("#button").addClass("btn-danger");
        $("#button").html("Pause");
    }
</script>
