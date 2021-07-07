$(function(){


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

});