<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="../JQuery/validating_input.js"></script>
    <style>
        .modal-header{
            letter-spacing: 3px;
            font-family: "Century Gothic", "Century", "Century Schoolbook";
        }
    </style>
</head>
<body style='font-family: "Century Gothic", "Century", "Century Schoolbook"'>

<div class="modal fade" id="reminderModal">
    <div class="modal-dialog modal-dialog-centered modal-md">
        <div class="modal-content">

            <div class="modal-header">
                <h4 class="modal-title">Add a Reminder</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <div class="modal-body">
                <div class="container" id="reminderContainer">

                    <!-- Form to add a reminder -->
                    <form method="post" action="../Controller/reminderController.php">
                        <label for="reminder">
                            <p id="reminderMsg"></p>
                            <textarea id="reminder" maxlength="150" name="reminder" class="form-control userInput" cols="60" rows="7" placeholder="Jot your thoughts down here..." required></textarea>
                        </label>

                        <button type="submit" class="btn btn-success float-right" name="addReminder" id="addReminder">Add Reminder</button>
                    </form>

                </div>
            </div>

        </div>
    </div>
</div>

</body>
</html>


