$(function(){

    //If user checks a box next to a task
    $(".complete").click(function(){
        //Get the id of the checkbox to find the task
        let theId = this.id;

        window.location.href = '../Controller/create_task.php?task='+theId;
        console.log("here");
    });
});