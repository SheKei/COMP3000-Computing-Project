$(function(){

    //If user checks a box next to a task
    $(".complete").click(function(){
        //Get the id of the checkbox to find the task
        let theId = event.target.id;
        window.location.href = '../Controller/taskController.php?task='+theId;
    });
});