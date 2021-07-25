<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script src="../JQuery/module_controller.js"></script>
    <script src="../JQuery/validating_input.js"></script>
    <script src="../JQuery/check_date.js"></script>

    <style>
        label{font-size: 20px;}

        #theDateMsg, #theTimeMsg{color: #FF5C4D;}
    </style>
</head>
<body>

<div class="modal fade" id="changeDateTimeModalFromHome" style='font-family: "Century Gothic", "Century", "Century Schoolbook"'>
    <div class="modal-dialog modal-dialog-centered modal-xs">
        <div class="modal-content">

            <div class="modal-header">
                <h4 style="font-family:'Century Gothic'" class="modal-title">Set Deadline</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <div class="modal-body">
                <div class="container" >
                    <p id="dateErrorMsg"></p>
                    <input class="form-control" name="theDateInput" id="theDateInput" type="date"><br>
                    <p id="timeErrorMsg"></p>
                    <input class="form-control" name="theTimeInput" id="theTimeInput" type="time"><br><br>

                    <button id="confBtn" class="btn btn-success float-right" type="button" data-dismiss="modal" disabled>
                        Confirm New Date</button>
                    <button id="removeBtn" class="btn btn-dark float-left" type="button" data-dismiss="modal">
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

        $("#theDateInput").change(function(){
            checkDate();
            checkTime();
        })

        $("#theTimeInput").change(function(){
            checkTime();
            checkDate();
        })

        //check if date is entered and is not in the past
        function checkDate() {
            //Get input date and current date
            let inputDate = $("#theDateInput").val();
            let currentDate = getCurrentDate();

            if(inputDate==""){
                $("#dateErrorMsg").html("Please enter a date!");
                $("#confirmBtn").prop("disabled", true); //Keep confirm btn disabled
            }else if(inputDate < currentDate){//Check if input date isn't set in the past
                $("#dateErrorMsg").html("Due deadline has already passed!");
                $("#confirmBtn").prop("disabled", true); //Keep confirm btn disabled
            }else{
                $("#dateErrorMsg").html("");
                $("#confBtn").prop("disabled", false);
            }
        }

        //Check if time input is entered
        function checkTime(){
            let inputTime = $("#theTimeInput").val();

            if(inputTime == ""){//if input incomplete
                $("#timeErrorMsg").html("Please enter a time for the deadline!");
                $("#confirmBtn").prop("disabled", true); //Keep confirm btn disabled
            }else{
                $("#timeErrorMsg").html("");
                $("#confBtn").prop("disabled", false);
            }
        }

    });
</script>


