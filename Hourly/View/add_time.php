<!DOCTYPE html>
<?php
include_once '../Controller/Task_Controller.php';
include_once '../Controller/Dropdown_Menu_Controller.php';
$dropdown = new Dropdown_Menu_Controller('dummy');
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <style>
        label{font-size: 20px;}
    </style>
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
                <div class="container" id="timeContainer" style="font-size: 20px;">

                    <form method="post" action="../Controller/timeController.php">

                        <!-- DROP DOWN MENU TO SELECT ONGOING TASK-->
                        <div class="form-row">
                            <div style="margin-left: 3px;" class="form-group row">
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

                        <div class="form-row">
                            <div style="margin-left: 3px;" class="form-group row">
                                <div class="col-auto">
                                    <label for="moduleChoice" class="col-form-label">Module: <label>
                                </div>
                                <div class="col-auto">
                                    <select class="form-control" name="moduleChoice" id="moduleChoice">
                                        <?php
                                        $firstChoice = $dropdown->displayModuleDropDown();
                                        ?>
                                    </select>
                                </div>
                                <div class="col-auto">
                                    <label for="taskChoice">Task:</label>
                                </div>
                                <div class="col-auto">
                                    <select class="form-control" name="taskChoice" id="taskChoice">
                                    <?php
                                      $dropdown->displayModuleTasks($firstChoice);
                                    ?>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <!-- SECTION TO INPUT TIME SPENT ON TASK -->
                        <div class="form-row">
                            <div class="form-group row">

                                <div class="col-2">
                                    <label style="font-size: 20px" for="time" class="col-form-label">Time spent: </label style="font-size: 20px">
                                </div>
                                <div class="col-2">
                                    <input class="form-control" type ="number" min="0" max="23" id="hour" placeholder="1" name="hour" required>
                                </div>
                                <div class="col-2">
                                    <label for="hour">hour(s) </label>
                                </div>
                                <div class="col-2">
                                    <input class="form-control" type="number" min="0" max="59" placeholder="30" id="minute" name="minute" required>
                                </div>
                                <div class="col-2">
                                    <label for="minute">minute(s)</label>
                                </div>
                            </div>
                        </div>

                        <!-- DESCRIPTION BOX -->
                        <div class="form-group-row">
                            <label for="description">Description (Optional):</label>
                            <textarea class="form-control" placeholder="Finished practical 1" id="description" name="description" rows="3"></textarea>
                        </div><br>

                        <!-- TIME STAMP -->
                        <div class="form-group row">

                            <div class="col-2">
                                <label class="col-form-label">Date of Studying: <label>
                            </div>
                            <div class="col-3">
                                <input class="form-control" type="date" id="date" name="date" required>
                            </div>
                            <div class="col-2">
                                <button type="button" class="btn btn-dark" id="btnToday">Today's Date!</button>
                            </div>
                        </div>


                        <!-- SUBMIT BTN -->
                        <input style="font-size: 20px" type="submit" class="btn btn-primary float-right" name="addTimeBtn" id="addTimeBtn" value="Add Time">
                    </form>

                </div>
            </div>

        </div>
    </div>
</div>

</body>
</html>
<script>
    $(function(){
        $("#moduleChoice").change(function(){
            //alert($("#moduleChoice").val());

            if($("#moduleChoice").val()){
                let xmlhttpMenu = new XMLHttpRequest();
                //Wait for response
                xmlhttpMenu.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                        $("#taskChoice").html(this.responseText); //Output details of clicked class
                    }
                }

                //Send class id to retrieve details
                xmlhttpMenu.open("GET","../Controller/dropdownMenuController.php?moduleCodeMenu="+$("#moduleChoice").val(),true);
                xmlhttpMenu.send();
            }
        });

        //Change date input field to today's date
        $("#btnToday").click(function(){
            let d = new Date();
            let month = d.getMonth(); let day = d.getDay();
            if(d.getDay()<10){
                day = "0"+day;
            }
            if(d.getMonth()<10){
                month = "0"+month;
            }
            $("#date").val(d.getFullYear()+"-"+month+"-"+day);
        });

    });
</script>

