$(function(){

    //Inform user how many characters they have left
    $('.userInput').on('keyup', function() {
        //Get current number of characters typed into
        let currentLength = $(this).val().length;
        //Find the max char length for a field
        let maxLength = $(this).attr('maxLength');

        //Calculate how many left
        let remaining =  maxLength - currentLength - 1;
        let message = "("+ remaining +" Characters Remaining)";

        //Find which input field is being typed into
        let theId = event.target.id;
        console.log(theId);
        //Find location to output message to
        switch (theId) {
            case "moduleCode": //If adding module
                $("#codeChars").html(message);
                break;
            case "moduleName":
                $("#nameChars").html(message);
                break;
            case "taskName":
                $("#taskNameChars").html(message);
                break;
            case "code": //If viewing module details
                $("#editCodeChars").html(message);
                break;
            case "name":
                $("#editNameChars").html(message);
                break;
            case "reminder":
                $("#reminderMsg").html(message);
                break;

        }
    });
});