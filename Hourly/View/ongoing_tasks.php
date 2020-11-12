<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <style>
        #ongoingTasksSection{
            margin-left: 25%;
        }

        .category{
            border: 1px solid black;
            border-radius: 5px;
            margin: 10px;
            min-height: 500px;
        }

        #general, #revision, #coursework{text-align: center;}

    </style>
</head>
<body>

    <div class="container" id="ongoingTasksSection">
        <div class="row">
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
