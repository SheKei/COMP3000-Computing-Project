<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script src="https://kit.fontawesome.com/20c7401107.js" crossorigin="anonymous"></script>
    <style>
        .hidden{
            display: none;
        }

        .category{
            border: 1px solid black;
            border-radius: 5px;
            margin: 10px;
            min-height: 500px;
        }

        #ongoingTasksSection{
            border-radius: 25px;
            border: 2px solid black;
            padding: 20px;
            width: 100%;
            min-height: 600px;
        }


        #general, #revision, #coursework{text-align: center;}

    </style>
</head>
<body>

    <div class="container moduleColor" id="ongoingTasksSection" >
        <h2>Ongoing Tasks <i id="ongoing" class="fas fa-expand-alt"></i></h2>
        <div class="row" id="ongoingBoard">
            <div class="col-lg category">
                <h2 id="general">General</h2>
                <p id="generalTasks"></p>
            </div>
            <div class="col-lg category">
                <h2 id="revision">Revision</h2>
                <p id="revisionTasks"></p>
            </div>
            <div class="col-lg category">
                <h2 id="coursework">Coursework</h2>
                <p id="courseworkTasks"></p>
            </div>
        </div>
    </div>

</body>
</html>

<script>
    $(function(){

        //If user checks a box next to a task
        $("#ongoing").click(function(){
            if($("#ongoingBoard").hasClass("hidden")){
                $("#ongoingBoard").removeClass("hidden");
                $('#ongoingTasksSection').css('min-height', '600px');
            }else{
                $("#ongoingBoard").addClass("hidden");
                $('#ongoingTasksSection').css('min-height', '20px');
            }
        });
    });
</script>
