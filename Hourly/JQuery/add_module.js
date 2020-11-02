$(function(){
    $(".colourBtn").click(function(){
        //Find the id of the button that was clicked
        let theId = event.target.id;

        //Use id to extract colour value
        let colour = $("#" + theId).css("color");

        //Display the chosen colour in input box
        $("#keyColour").css("color", colour);
    });
});