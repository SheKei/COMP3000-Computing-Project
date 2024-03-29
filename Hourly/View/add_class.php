<?php include_once '../Controller/taskController.php';?>
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

<div class="modal fade" id="classModal">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">

            <div class="modal-header">
                <h4 class="modal-title">Add a Class</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <div class="modal-body">
                <div class="container" >
                    <form method="post" action="../Controller/classController.php">
                    <!-- ASSIGN CLASS TO MODULE -->
                    <div class="row">
                        <div class="col-sm-2">
                            <label for="moduleCode">Module:</label>
                        </div>
                        <div class="col-sm-6">
                            <select id="moduleCode" name="moduleCode" class="form-control">
                                <?php
                                $controller = new Task_Controller('dummy');
                                $controller->displayModuleChoices();
                                ?>
                            </select>
                        </div>
                    </div>
                    <br>
                    <!-- CLASS NAME -->
                    <div class="row">
                        <div class="col-sm-2">
                            <label for="className">Name:</label>
                        </div>
                        <div class="col-sm-6">
                            <input name="className" id="className" type="text" placeholder="Class Name" class="form-control" required>
                        </div>
                    </div>
                    <br>
                    <!-- CLASS LOCATION -->
                    <div class="row">
                        <div class="col-sm-2">
                            <label for="classRoom">Location:</label>
                        </div>
                        <div class="col-sm-6">
                            <input name="classRoom" id="classRoom" type="text" placeholder="Class Room" class="form-control" required>
                        </div>
                    </div>
                    <br>
                    <!-- DAY CLASS OCCURS -->
                    <div class="row">
                        <div class="col-sm-2">
                            <label for="classDay">Day:</label>
                        </div>
                        <div class="col-sm-6">
                            <select id="classDay" name="classDay" class="form-control">
                                <option value="0">Monday</option>
                                <option value="1">Tuesday</option>
                                <option value="2">Wednesday</option>
                                <option value="3">Thursday</option>
                                <option value="4">Friday</option>
                            </select>
                        </div>
                    </div>
                    <br>
                    <!-- TIME CLASS STARTS -->
                    <div class="row">
                        <div class="col-sm-2">
                            <label for="startTime">Start Time:</label>
                        </div>
                        <div class="col-sm-6">
                            <input name="startTime" id="startTime" type="time" class="form-control" required>
                        </div>
                    </div>
                    <br>
                    <!-- DURATION OF CLASS -->
                    <div class="row">

                        <div class="col-sm-2">
                            <label>Class Duration:</label>
                        </div>
                        <div class="col-sm-2">
                            <input name="hour" id="hour" min="0" max="23" type="number" class="form-control" placeholder="2" required>
                        </div>
                        <div class="col-sm-1">
                            <label for="hour">hour(s)</label>
                        </div>

                        <div class="col-sm-2">
                            <input name="minutes" id="minutes" min="0" max="59" type="number" class="form-control" placeholder="30" required>
                        </div>
                        <div class="col-sm-1">
                            <label for="minutes">minute(s)</label>
                        </div>
                    </div>
                    <button style="font-size:20px" class="btn btn-primary float-right" id="classBtn" name="classBtn" type="submit">Add Class</button>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>

</body>
</html>


