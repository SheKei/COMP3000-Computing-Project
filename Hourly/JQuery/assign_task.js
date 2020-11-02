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

});