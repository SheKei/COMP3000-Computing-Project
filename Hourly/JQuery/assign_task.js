$(function(){
    //If set deadline option is clicked
    $("#setDeadline").click(function(){
        //Reveal input form to set deadline
        $(".deadline").removeClass("hidden");
    });

    $("#dueAnytime").click(function(){
        //Reveal input form to set deadline
        $(".deadline").addClass("hidden");
    });
});