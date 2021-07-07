
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script src="../JQuery/module_controller.js"></script>
    <script src="../JQuery/validating_input.js"></script>

    <style>
        label{font-size: 20px;}
    </style>
</head>
<body>

<div class="modal fade" id="setDateTimeModal" style='font-family: "Century Gothic", "Century", "Century Schoolbook"'>
    <div class="modal-dialog modal-dialog-centered modal-xs">
        <div class="modal-content">

            <div class="modal-header">
                <h4 style="font-family:'Century Gothic'" class="modal-title">Set Deadline</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <div class="modal-body">
                <div class="container" >
                    <input class="form-control" name="theDate" id="theDate" type="date"><br>
                    <input class="form-control" name="theTime" id="theTime" type="time"><br><br>

                    <button class="btn btn-success float-right" type="button">Confirm New Date</button>
                </div>
            </div>

        </div>
    </div>
</div>

</body>
</html>


