$(function(){

    //If set deadline option is clicked
    $("#setDeadline").click(function(){
        //Reveal input form to set deadline
        $(".deadline").removeClass("hidden");
        checkTaskName();
    });

    //If user doesn't want to set a deadline
    $("#dueAnytime").click(function(){
        //Hide deadline section
        $(".deadline").addClass("hidden");
        checkTaskName();
    });



    //Check the deadline time set
    $('#dueTime').change(function() {
        //Clear error message
        $("#timeMessage").html("");

        //Check if a date has been inputted
        let inputDate = $("#dueDate").val();

        if(inputDate === ""){
            $("#timeMessage").html("Please enter a date as well!");
            $("#addTaskBtn").prop("disabled", true); //Keep btn disabled
        }
        else{
            $("#addTaskBtn").prop("disabled", false);
        }
    });

    //Check if all fields have been filled in
    $(".taskInput").change(function(){

        $("#requiredMessageTask").html("")

        let taskName = $("#taskName").val();
        let dueDate = $("#dueDate").val();
        let dueTime = $("#dueTime").val();

        //If user set a deadline, check deadline
        if($("#setDeadline").is(':checked') == true)
        {
            console.log("here");
            checkTaskName();
            checkDeadline();
        }
        else{
            console.log("else");
            checkTaskName();
        }



    });

    //Check the deadline date set
    $('#dueDate').change(function() {
        checkDeadline();
    });

    function checkTaskName(taskName)
    {
        if(taskName == "")
        {
            $("#requiredMessageTask").html("All fields are required to assign a task!");
            $("#addTaskBtn").prop("disabled", true); //Keep btn disabled
        }
        else
        {
            $("#addTaskBtn").prop("disabled", false); //Enable create btn
        }
    }

    function checkDeadline()
    {
        //Clear any previous messages
        $("#deadlineMessage").html("");

        //Get input date and current date
        let inputDate = $("#dueDate").val();
        let currentDate = getCurrentDate();

        //Check if input date isn't set in the past
        if(inputDate < currentDate){
            $("#deadlineMessage").html("Due deadline has already passed!");
            $("#addTaskBtn").prop("disabled", true); //Keep btn disabled
        }
        else{
            $("#timeMessage").html("");
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

        let currentDate = d.getFullYear() + "-" + month  + "-" + day;
        return currentDate;
    }

});