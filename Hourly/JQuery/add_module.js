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

        $("#requiredMessage").html("");
        $("#requiredMsg").html("");
        let moduleCode, moduleName, moduleHours, msgId, btnId;

        let id = event.target.id;
        if($("#"+id).hasClass("form-control userInput moduleInput viewModule")){
            moduleCode = $("#code").val();
            moduleName = $("#name").val();
            moduleHours = $("#hour").val();
            msgId = "requiredMsg";
            btnId = "saveModuleBtn"
        }
        else{
            moduleCode = $("#moduleCode").val();
            moduleName = $("#moduleName").val();
            moduleHours = $("#hours").val();
            msgId = "requiredMessage";
            btnId = "addModuleBtn";
        }
        console.log("hour " + moduleHours);

        if(moduleCode == "" || moduleName == ""){
            $("#" + msgId).html("All fields are required to create a module!");
            $("#" + btnId).prop("disabled", true); //Keep btn disabled
            console.log("empty");
        }
        else
        {
            console.log("here");
            $("#"+ btnId).prop("disabled", false); //Enable create btn
        }
    });
});