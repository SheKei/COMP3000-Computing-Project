$(function(){

    //Inform user how many characters they have left
    $('.userInput').on('keypress', function() {
        //Get current number of characters typed into
        let currentLength = $(this).val().length;
        //Find the max char length for a field
        let maxLength = $(this).attr('maxLength');

        //Calculate how many left
        let remaining =  maxLength - currentLength - 2;
        console.log(remaining);
        let message = "("+ remaining +" Characters Remaining)";

        //Find which input field is being typed into
        let theId = this.id;

        //Output chars remaining message below field
        if(theId == "moduleCode"){
            $("#codeChars").html(message);
        }
        else if(theId == "moduleName"){
            $("#nameChars").html(message);
        }
        else if(theId == "taskName")
        {
            $("#taskNameChars").html(message);
        }
    });
});