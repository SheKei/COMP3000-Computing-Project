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

    //Filter out forbidden characters as user enters each character
    $('.userInput').on('keypress', function() {
        $(this).val($(this).val().replace(/[^a-z0-9_ -]/s, ''));

        //How many characters remaining
        let remaining = 50 - $(this).val().length;
        let message = "("+ remaining +" Characters Remaining)"

        //Which input is being typed into
        let theId = this.id;

        if(theId == "moduleCode"){
            $("#codeChars").html(message);
        }
        else{
            $("#nameChars").html(message);
        }
    });



});