<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script src="https://kit.fontawesome.com/20c7401107.js" crossorigin="anonymous"></script>
    <style>

        .category{
            border: 1px solid black;
            border-radius: 5px;
            margin: 10px;
            min-height: 500px;
        }

        #completedTasksSection{
            border-radius: 25px;
            border: 2px solid black;
            padding: 20px;
            width: 100%;
            min-height: 600px;
            margin-top: 25px;
        }

        h2{font-family: "Century Gothic", "Century", "Century Schoolbook"; letter-spacing: 3px;}

        #general, #revision, #coursework{text-align: center;}

    </style>
</head>
<body>

<div class="container moduleColor" id="completedTasksSection">
    <h2>Completed Tasks <i id="complete" class="fas fa-expand-alt"></i></h2>
    <div class="row" id="completedBoard">
        <div class="col-lg category">
            <h2 id="general">General</h2>
            <p id="completedGeneralTasks"></p>
        </div>
        <div class="col-lg category">
            <h2 id="revision">Revision</h2>
            <p id="completedRevisionTasks"></p>
        </div>
        <div class="col-lg category">
            <h2 id="coursework">Coursework</h2>
            <p id="completedCourseworkTasks"></p>
        </div>
    </div>
</div>

</body>
</html>

<script>
    $(function(){

        //If user checks a box next to a task
        $("#complete").click(function(){
            if($("#completedBoard").hasClass("hidden")){
                $("#completedBoard").removeClass("hidden");
                $('#completedTasksSection').css('min-height', '600px');
            }else{
                $("#completedBoard").addClass("hidden");
                $('#completedTasksSection').css('min-height', '20px');
            }
        });
    });
</script>
