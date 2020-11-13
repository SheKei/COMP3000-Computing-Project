$(function(){
    $(".colourBtn").click(function(){

        //Find the id of the button that was clicked
        let theId = this.id;
        theId = "#" + theId;

        //Use id to extract colour value
        let colour = $(theId).css("color");

        //Display the chosen colour in input box
        $("#keyColour").css("color", colour);
        //$("#colour").val("here");
    });

    //Check if all fields have been filled in before creating a module
    $(".moduleInput").change(function(){

        $("#requiredMessage").html("")

        let moduleCode = $("#moduleCode").val();
        let moduleName = $("#moduleName").val();
        let moduleHours = $("#hours").val();

        if(moduleCode == "" || moduleName == "" || moduleHours == ""){
            $("#requiredMessage").html("All fields are required to create a module!");
            $("#addModuleBtn").prop("disabled", true); //Keep btn disabled
        }
        else
        {
            $("#addModuleBtn").prop("disabled", false); //Enable create btn
        }
    });
});