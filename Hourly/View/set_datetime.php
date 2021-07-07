
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script src="../JQuery/module_controller.js"></script>
    <script src="../JQuery/validating_input.js"></script>

    <style>
        label{font-size: 20px;}

        #dateMsg, #timeMsg{color: #FF5C4D;}
    </style>
</head>
<body>

<div class="modal fade" id="setDateTimeModal" style='font-family: "Century Gothic", "Century", "Century Schoolbook"'>
    <div class="modal-dialog modal-dialog-centered modal-xs">
        <div class="modal-content">

            <div class="modal-header">
                <h4 style="font-family:'Century Gothic'" class="modal-title">Set Deadline</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <div class="modal-body">
                <div class="container" >
                    <p id="dateMsg"></p>
                    <input class="form-control" name="theDate" id="theDate" type="date"><br>
                    <p id="timeMsg"></p>
                    <input class="form-control" name="theTime" id="theTime" type="time"><br><br>

                    <button id="confirmDateBtn" class="btn btn-success float-right" type="button" data-dismiss="modal">
                        Confirm New Date</button>
                </div>
            </div>

        </div>
    </div>
</div>

</body>
</html>
<script>
    $(function(){

        $("#theDate").change(function(){
            checkDate();
        })

        $("#theTime").change(function(){
            checkTime();
        })

        //check if date is entered and is not in the past
        function checkDate() {
            //Get input date and current date
            let inputDate = $("#theDate").val();
            let currentDate = getCurrentDate();

            if(inputDate==""){
                $("#dateMsg").html("Please enter a date!");
                $("#confirmDateBtn").prop("disabled", true); //Keep confirm btn disabled
            }else if(inputDate < currentDate){//Check if input date isn't set in the past
                $("#dateMsg").html("Due deadline has already passed!");
                $("#confirmDateBtn").prop("disabled", true); //Keep confirm btn disabled
            }else{
                $("#dateMsg").html("");
                $("#confirmDateBtn").prop("disabled", false);
            }
        }

        //Check if time input is entered
        function checkTime(){
            let inputTime = $("#theTime").val();

            if(inputTime == ""){//if input incomplete
                $("#timeMsg").html("Please enter a time for the deadline!");
                $("#confirmDateBtn").prop("disabled", true); //Keep confirm btn disabled
            }else{
                $("#timeMsg").html("");
                $("#confirmDateBtn").prop("disabled", false);
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


