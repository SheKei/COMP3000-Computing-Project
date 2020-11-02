$(function(){
    //Filter out forbidden characters as user enters each character
    $('.userInput').on('keypress', function() {
        //How many characters remaining
        let currentLength = $(this).val().length;
        let maxLength = $(this).attr('maxLength');
        let remaining =  maxLength - currentLength;
        let message = "("+ remaining +" Characters Remaining)";

        //Which input field is being typed into
        let theId = this.id;
        
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