<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
</head>
<body>
    <div class="modal fade" id="taskModal">
        <div class="modal-dialog modal-dialog-centered modal-xl">
            <div class="modal-content">

                <div class="modal-header">
                    <h4 class="modal-title">Assign a Task</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <div class="modal-body">
                    <div class="container" id="moduleContainer">

                        <!-- INPUT TASK NAME -->
                        <div class="form-group row">
                            <label for="taskName" class="col-form-label">Task Name: </label>
                            <div class="col-10">
                                <input class="form-control" type="text" id="taskName">
                            </div>
                        </div>

                        <!-- ASSIGN TO MODULE -->
                        <div class="form-row">
                            <div class="form-group row">
                                <label for="moduleCode" id="moduleLabel" class="col-form-label">Assign to Module: <label>
                                        <div class="col-auto">
                                            <select class="form-control" id="moduleCode">
                                                <option>COMP3000</option>
                                                <option>COMP3005</option>
                                                <option>COMP3006</option>
                                            </select>
                                        </div>
                            </div>

                            <!-- CATEGORISE TASK -->
                            <div class="form-group row">
                                <label for="taskCategory" id="categoryLabel" class="col-form-label">Task Category: <label>
                                    <div class="col-auto">
                                        <select class="form-control" id="taskCategory">
                                            <option value="General">General</option>
                                            <option value="Revision">Revision</option>
                                            <option value="Coursework">Coursework</option>
                                        </select>
                                    </div>
                            </div>
                        </div>

                        <!-- ASSIGN A PRIORITY LEVEL (DEFAULT: MEDIUM) -->
                        <div class="form-group row">
                            <label class="col-form-label">Priority Level: <label>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="priorityOptions" id="lowRadio" value="Low">
                                    <label class="form-check-label" for="priorityOptions">Low</label>
                                </div>

                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="priorityOptions" id="mediumRadio" value="Medium" checked>
                                    <label class="form-check-label" for="priorityOptions">Medium</label>
                                </div>

                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="priorityOptions" id="highRadio" value="High">
                                    <label class="form-check-label" for="priorityOptions">High</label>
                                </div>
                        </div>

                        <!-- OPTIONAL TO SET DEADLINE -->
                        <div class="form-group row">
                            <label class="col-form-label">Due Deadline: <label>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="dueDeadline" id="dueAnytime" value="dueAnytime" checked>
                                    <label class="form-check-label" for="dueDeadline">Due Anytime</label>
                                </div>

                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="dueDeadline" id="setDeadline">
                                    <label class="form-check-label" for="dueDeadline">Set a Deadline</label>
                                </div>
                        </div>

                        <!-- SET THE DATE OF DEADLINE -->
                        <section class="deadline">
                            <div class="form-group row">
                                <label for="dueDate" class="col-form-label">Due Date: </label>
                                <div class="col-auto">
                                    <input class="form-control" type="date" id="dueDate" name="dueDate">
                                </div>

                            </div>
                            <!-- SET THE TIME OF DEADLINE -->
                            <div class="form-group row">
                                <label for="dueTime" class="col-form-label">Due Time: </label>
                                <div class="col-auto">
                                    <input class="form-control" type="time" id="dueTime" name="dueTime">
                                </div>
                            </div>
                        </section>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-primary">Add Task</button>
                </div>
            </div>
        </div>
    </div>

</body>
</html>


