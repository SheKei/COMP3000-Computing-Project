<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

</head>
<body>

<div class="modal fade" id="deleteModuleWarning">
    <div class="modal-dialog modal-dialog-centered modal-md">
        <div class="modal-content">
            <div class="modal-body">
                <div class="container">
                    <p><strong>WARNING:</strong> Deleting all modules will result in all tasks and records of time spent deleted!</p>
                    <p>Please confirm you would like to delete this module:</p>
                    <button type="button" class="btn btn-danger" id="confirmDelete">DELETE MODULE</button>
                    <button type="button" class="btn btn-info" id="cancel" data-dismiss="modal">CANCEL</button>
                </div>
            </div>
        </div>
    </div>
</div>
    <script src="../JQuery/delete_module.js"></script>
</body>
</html>