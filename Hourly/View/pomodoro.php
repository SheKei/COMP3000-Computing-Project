<?php
//include_once '../Controller/Task_Controller.php';
//$taskController = new Task_Controller('dummy');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://kit.fontawesome.com/20c7401107.js" crossorigin="anonymous"></script>
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
            min-height: 600px;
            background-color: white;
        }

        #timePanel{
            width: 600px;
            height: 300px;
            margin-right: auto;
            margin-left: auto;
        }

        #addTimePanel{

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

         #finishedMsg{
             letter-spacing: 3px;
             font-weight: bold;
             font-size: 30px;
             color: mediumseagreen;
         }

         #startBtn, #pauseBtn, #resetBtn{
             font-size: 20px;
         }

         .hidden{
             display: none;
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

        <form method="POST" action="../Controller/timeController.php">
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
                <button type="button" class="btn btn-dark time" id="decrementBtn"><i class="fas fa-minus-circle"></i></button>
                <span id="timeChosen">25</span><span> minutes </span>
                <button type="button" class="btn btn-dark time" id="incrementBtn"><i class="fas fa-plus-circle"></i></button>
            </p>

        </div>

        <div id="timePanel">
            <p class="text-center" id="timer"></p>
            <div id="btnPanel" class="text-center">
                <button type="button" class="btn btn-success" id="startBtn">Start</button>
                <button type="button" class="btn btn-danger" id="pauseBtn">Pause</button>
                <button type="button" class="btn btn-dark" id="resetBtn">Reset</button>
                <button type="button" class="btn btn-default" id="testBtn">Test</button>
            </div><br>
            <p class="text-center hidden" id="finishedMsg">POMODORO SESSION COMPLETED - GOOD WORK!</p>
        </div>
        <br>
        <div id="addTimePanel">
            <div class="row">
                <div class="col-lg-9">

                    <input type="number" class="form-control hidden" name="workedFor" id="workedFor" readonly>
                    <textarea class="form-control text-center" id="description" name="description"
                              placeholder="Add a description of what you did if you like..." cols="20" rows="5"></textarea>
                </div>
                <div class="col-lg-3 text-center">
                    <br><br>
                    <button type="submit" class="btn btn-success btn-lg" name="saveTimeBtn" id="saveTimeBtn">Add Time To Task</button>
                    </form>
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
        var chosenTime;
        var theTimer;
        $("#timer").html(calculateTime(remainingTime));
        $("#saveTimeBtn").prop('disabled', true);
        $("#workedFor").val(totalMinutes);

        //Update the selected time for timer
        function changeMinutes(){
            totalMinutes = chosenTime;
            remainingTime = totalMinutes * 60;
            $("#workedFor").val(totalMinutes);
        }


        //Increment time by 5
        $("#incrementBtn").click(function(){
            chosenTime = Number($("#timeChosen").html());   //Get current minutes
            chosenTime = chosenTime + 5;                    //Increment current minutes by 5
            displaySelectedTime();                          //Display change in time
            changeMinutes();                                //Copy new time to timer
        });

        //Check and decrement current time by 5
        $("#decrementBtn").click(function(){
            chosenTime = Number($("#timeChosen").html());   //Get current chosen time
            if(chosenTime > 5){
                chosenTime = chosenTime - 5;                //Decrement current if minutes more than 5
            }else{
                chosenTime = 5;                             //Else leave at 5 minutes
            }
            displaySelectedTime();                          //Display change in time
            changeMinutes();                                //Copy to new time to timer
        });


        //Start btn to start timer
        $("#startBtn").click(function(){
           theTimer = setInterval(startTimer, 1000);        //Start counting down seconds
           $("#startBtn").prop('disabled', true);           //Disable start btn
           $("#pauseBtn").prop('disabled', false);          //Enable pause btn
           $("#incrementBtn").prop('disabled', true);       //Disable option to change chosen time once timer enabled
           $("#decrementBtn").prop('disabled', true);
        });

        //Pause btn to stop timer
        $("#pauseBtn").click(function(){
           clearInterval(theTimer);                         //Pause count down
           $("#startBtn").prop('disabled', false);          //Enable start btn
           $("#pauseBtn").prop('disabled', true);           //Disable pause btn
        });

        //Reset timer back to 25 minutes
        $("#resetBtn").click(function(){
            clearInterval(theTimer);                        //Stop count down
            resetTimer();                                   //Reset timer back to 25:00
            $("#startBtn").prop('disabled', false);         //Enable start btn
            $("#pauseBtn").prop('disabled', false);         //Enable pause btn
            $("#incrementBtn").prop('disabled', false);     //Re-enable option to change chosen time once reset
            $("#decrementBtn").prop('disabled', false);
            $("#saveTimeBtn").prop('disabled', true);       //Disable btn to save time to task
        });

        //Reset timer back to 25 minutes
        $("#testBtn").click(function(){
            testTime();
        });

        //Deduct 1 second off remaining time
        function startTimer(){
            remainingTime--;
            displayRemainingTime(remainingTime);
            //IF TIMER IS FINISHED
            if(remainingTime <= 0){
                clearInterval(theTimer);
                $("#startBtn").prop('disabled', true);      //Disable start btn
                $("#pauseBtn").prop('disabled', true);      //Disable pause btn
                $("#finishedMsg").removeClass("hidden");    //Reveal finished message
                $("#saveTimeBtn").prop('disabled', false);    //Enable the add time btn
            }
        }

        //Display remaining time mm:ss during countdown
        function displayRemainingTime(){
            $("#timer").html(calculateTime(remainingTime));
        }

        //Display current chosen time on timer
        function displaySelectedTime(){
            $("#timeChosen").html(chosenTime);
            $("#timer").html(calculateTime(chosenTime*60));
        }

        //Reset remaining time back to 25 minutes
        function resetTimer(){
            totalMinutes = 25;
            remainingTime = totalMinutes * 60;
            displayRemainingTime();
        }

        function testTime(){
            remainingTime = 5;
        }

    });

    //Format time in seconds into mm:ss
    function calculateTime(time){
        let quotient = parseInt(time/60);
        let remainder = time%60;

        if(remainder < 10){
            remainder = "0" + remainder;
        }
        return quotient + ":" + remainder;
    }

</script>
