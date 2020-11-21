<!DOCTYPE html>
<?php include_once '../Controller/Task_Controller.php';?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
</head>
<body>

<div class="modal fade" id="timeModal">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">

            <div class="modal-header">
                <h4 class="modal-title">Add Time</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <div class="modal-body">
                <div class="container" id="timeContainer">

                    <form method="post" action="../Controller/timeController.php">

                        <!-- DROP DOWN MENU TO SELECT ONGOING TASK-->
                        <div class="form-row">
                            <div class="form-group row">
                                <label for="taskName" class="col-form-label">Task: <label>
                                        <div class="col-auto">
                                            <select class="form-control" name="taskName" id="taskName">
                                                <?php
                                                $controller = new Task_Controller('dummy');
                                                $controller->displayOngoingTasks();
                                                ?>
                                            </select>
                                        </div>
                            </div>
                        </div>

                        <!-- SECTION TO INPUT TIME SPENT ON TASK -->
                        <div class="form-row">
                            <div class="form-group row">
                                <div class="col-auto">
                                <label for="time" class="col-form-label">Time spent: </label>
                                <input class="form-control" type ="number" min="0" max="23" id="hour" placeholder="1" name="hour"> <label for="hour">hour(s) </label>
                                <input class="form-control" type="number" min="0" max="60" placeholder="30" id="minute" name="minute"><label for="minute">minutes</label>
                                </div>
                            </div>
                        </div>

                        <!-- DESCRIPTION BOX -->
                        <div class="form-group">
                            <label for="description">Description (Optional):</label>
                            <textarea class="form-control" placeholder="Finished practical 1" id="description" name="description" rows="3"></textarea>
                        </div>

                        <!-- TIME STAMP -->
                        <div class="form-group row">
                            <label class="col-form-label">Date of Studying: <label>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="todayDate" id="todayDate" value="today" checked>
                                        <label class="form-check-label taskInput" for="todayDate">Today</label>
                                    </div>

                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input taskInput" type="radio" name="anotherDate" id="anotherDate" value="another">
                                        <label class="form-check-label" for="anotherDate">Another Date</label>
                                    </div>
                        </div>

                        <div class="form-group row">
                            <label for="date" class="col-form-label">Date of Studying: </label>
                            <div class="col-auto">
                                <input class="form-control" type="date" id="date" name="date">
                            </div>
                        </div>

                        <!-- SUBMIT BTN -->
                        <input type="submit" class="btn btn-primary" name="addTimeBtn" id="addTimeBtn" value="Add Time">
                    </form>

                </div>
            </div>

        </div>
    </div>
</div>

</body>
</html>


