$(function(){
    $(".colourBtn").click(function(){

        //Find the id of the button that was clicked
        let theId = event.target.id;

        //Use id to extract colour value
        let colour = $("#" + theId).css("color");

        //Check if on add module page or edit module page and output to appropriate page
        if($("#"+theId).hasClass("fas fa-circle fa-3x edit")){
            $("#theKeyColour").css("color", colour);
            $("#theColour").val(colour);
        }else{
            $("#keyColour").css("color", colour);
            $("#thisColour").val(colour);
        }
    });

    //Check if all fields have been filled in before creating a module
    $(".moduleInput").change(function(){
        console.log("here");
        $("#requiredMessage").html("")

        let moduleCode = $("#moduleCode").val();
        let moduleName = $("#moduleName").val();
        let moduleHours = $("#hours").val();

        if(moduleCode == "" || moduleName == "" || moduleHours == ""){
            $("#requiredMessage").html("All fields are required to create a module!");
            $(".submitBtn").prop("disabled", true); //Keep btn disabled
        }
        else
        {
            $(".submitBtn").prop("disabled", false); //Enable create btn
        }
    });
});