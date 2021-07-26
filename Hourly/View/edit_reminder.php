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

<div class="modal fade" id="editReminderModal">
    <div class="modal-dialog modal-dialog-centered modal-md">
        <div class="modal-content">

            <div class="modal-header">
                <h4 class="modal-title">Edit Reminder</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <div class="modal-body">
                <div class="container" id="reminderContainer">
                <span id="editReminderForm"></span>


                </div>
            </div>

        </div>
    </div>
</div>

</body>
</html>


