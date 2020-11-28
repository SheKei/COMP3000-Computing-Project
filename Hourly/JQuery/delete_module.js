$(function(){

    //User confirms deleting module
    $("#confirmDelete").click(function(){
        let moduleCode = $("#moduleCodeCurrent").val();
        window.location.href = '../Controller/moduleController.php?module='+moduleCode;
    });
});