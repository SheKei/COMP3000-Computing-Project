$(function() {
    //User selects a time to delete

    $('.deleteTime').click(function(){
        let timeId = event.target.id; //Find the task that was clicked
        console.log("here");
        alert(timeId);

    });
});