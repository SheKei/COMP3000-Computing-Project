$(function(){
    function getCurrentDate()
    {
        let d = new Date();
        let month = d.getMonth() + 1;
        let day = d.getDate();

        if(day < 10) //Issues arise if day is a single digit
        {
            day = "0" + day;
        }

        if(month < 10){
            month = "0" + month;
        }

        let currentDate = d.getFullYear() + "-" + month  + "-" + day;
        return currentDate;
    }
});