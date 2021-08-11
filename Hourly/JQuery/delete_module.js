$(function(){

    //User confirms deleting module
    $("#confirmDelete").click(function(){
        let moduleCode = $("#moduleCodeCurrent").val();
        moduleCode = moduleCode.trim();
        window.location.href = '../Controller/moduleController.php?module='+moduleCode;
    });
});