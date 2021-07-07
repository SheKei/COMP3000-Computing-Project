$(function(){



    $('#taskName').on('keypress', function() {
        checkTaskName();
    })

    $('#taskName').on('keydown', function() {
        checkTaskName();
    })

    function checkTaskName(taskName)
    {
        taskName = $("#taskName").val();

        console.log(taskName.length);

        if(taskName.length == 0)
        {
            $("#taskMsg").html("Give a name for this task!");
            $("#addTaskBtn").prop("disabled", true); //Keep btn disabled
        }
        else
        {
            $("#taskMsg").html("");
            $("#addTaskBtn").prop("disabled", false); //Enable create btn
        }
    }

});