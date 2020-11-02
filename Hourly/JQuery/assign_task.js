$(function(){

    //If set deadline option is clicked
    $("#setDeadline").click(function(){
        //Reveal input form to set deadline
        $(".deadline").removeClass("hidden");
    });

    //If user doesn't want to set a deadline
    $("#dueAnytime").click(function(){
        //Hide deadline section
        $(".deadline").addClass("hidden");
    });

    //Check the deadline date set
    $('#dueDate').change(function() {
        //Clear any previous messages
        $("#deadlineMessage").html("");

        //Get input date and current date
        let inputDate = $("#dueDate").val();
        let currentDate = getCurrentDate();

        //Check if input date isn't set in the past
        if(inputDate < currentDate){
            $("#deadlineMessage").html("Due deadline has already passed!");
        }
        else{
            $("#timeMessage").html("");
        }
    });

    //Check the deadline time set
    $('#dueTime').change(function() {
        //Clear error message
        $("#timeMessage").html("");

        //Check if a date has been inputted
        let inputDate = $("#dueDate").val();

        if(inputDate === ""){
            $("#timeMessage").html("Please enter a date as well!");
        }
    });

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