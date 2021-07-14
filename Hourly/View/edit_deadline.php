
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script src="../JQuery/module_controller.js"></script>
    <script src="../JQuery/validating_input.js"></script>

    <style>
        label{font-size: 20px;}

        #theDateMsg, #theTimeMsg{color: #FF5C4D;}
    </style>
</head>
<body>

<div class="modal fade" id="changeDateTimeModal" style='font-family: "Century Gothic", "Century", "Century Schoolbook"'>
    <div class="modal-dialog modal-dialog-centered modal-xs">
        <div class="modal-content">

            <div class="modal-header">
                <h4 style="font-family:'Century Gothic'" class="modal-title">Set Deadline</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <div class="modal-body">
                <div class="container" >
                    <p id="theDateMsg"></p>
                    <input class="form-control" name="dateInput" id="dateInput" type="date"><br>
                    <p id="theTimeMsg"></p>
                    <input class="form-control" name="timeInput" id="timeInput" type="time"><br><br>

                    <button id="confirmBtn" class="btn btn-success float-right" type="button" data-dismiss="modal" disabled>
                        Confirm New Date</button>
                    <button id="removeDateBtn" class="btn btn-dark float-left" type="button" data-dismiss="modal">
                        Remove Deadline
                    </button>
                </div>
            </div>

        </div>
    </div>
</div>

</body>
</html>
<script>
    $(function(){

        $("#dateInput").change(function(){
            checkDate();
            checkTime();
        })

        $("#timeInput").change(function(){
            checkTime();
            checkDate();
        })

        //check if date is entered and is not in the past
        function checkDate() {
            //Get input date and current date
            let inputDate = $("#dateInput").val();
            let currentDate = getCurrentDate();

            if(inputDate==""){
                $("#theDateMsg").html("Please enter a date!");
                $("#confirmBtn").prop("disabled", true); //Keep confirm btn disabled
            }else if(inputDate < currentDate){//Check if input date isn't set in the past
                $("#theDateMsg").html("Due deadline has already passed!");
                $("#confirmBtn").prop("disabled", true); //Keep confirm btn disabled
            }else{
                $("#theDateMsg").html("");
                $("#confirmBtn").prop("disabled", false);
            }
        }

        //Check if time input is entered
        function checkTime(){
            let inputTime = $("#timeInput").val();

            if(inputTime == ""){//if input incomplete
                $("#theTimeMsg").html("Please enter a time for the deadline!");
                $("#confirmBtn").prop("disabled", true); //Keep confirm btn disabled
            }else{
                $("#theTimeMsg").html("");
                $("#confirmBtn").prop("disabled", false);
            }
        }

        function getCurrentDate()
        {
            let d = new Date();
            let month = d.getMonth() + 1;
            let day = d.getDate();

            if(day < 10) //Issues arise if day is a single digit
            {
                day = "0" + day;
            }

            if(month < 10){
                month = "0" + month;
            }

            let currentDate = d.getFullYear() + "-" + month  + "-" + day;
            return currentDate;
        }
    });
</script>


