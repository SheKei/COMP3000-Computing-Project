<?php
include_once '../Controller/module_controller.php';
include_once '../Controller/task_controller.php';
include_once 'view_task.php'; //Pop-up page for viewing task details

if(isset($_GET['code']))
{
    include_once '../Public/top_navbar.php';
    include_once '../Public/side_navbar.php';

    $controller = new module_controller("dummy");
    $taskControl = new task_controller('dummy');

    //Get module details
    $result = $controller->displayModulePage($_GET['code']);

    //If module details are returned
    if(isset($result))
    {
        foreach($result as $row){
            $code = $row['module_code'];
            $name = $row['module_name'];
            $hours = $row['expected_hours'];
            $colour = $row['colour_key'];

            $controller->displayPageHeading($code, $name);

        }
    }

}else{
    header('Location: home.php');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="../JQuery/complete_task.js"></script>
    <script src="../JQuery/add_module.js"></script>
    <script src="../JQuery/validating_input.js"></script>
    <style>
        #heading, #buttonDisplay{
            margin-left: 20%;
        }

        #theKeyColour{color: <?php echo $colour; ?>}

        #moduleCodeCurrent{display:none;}
    </style>
</head>
<body>
        <div class="modal fade" id="viewModule">
            <div class="modal-dialog modal-dialog-centered modal-xl">
            <div class="modal-content">

                <div class="modal-header">
                    <h4 class="modal-title"><?php echo $code." - ".$name; ?></h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <div class="modal-body">
                    <div class="container" id="moduleContainer">
                    <!-- Form to create module -->
                        <form method="post" action="../Controller/create_module.php">
                            <input class="form-control userInput moduleInput" type="text" name="moduleCodeCurrent" id="moduleCodeCurrent" maxlength="50" value="<?php echo $code; ?>"><br>
                            <label>Module Code: <p id="editCodeChars"></p> </label><input class="form-control userInput moduleInput viewModule" type="text" name="code" id="code" maxlength="50" value="<?php echo $code; ?>"><br>
                            <label>Module Name: <p id="editNameChars"></p> </label><input class="form-control userInput moduleInput viewModule" type="text" name="name" id="name" maxlength="50" value="<?php echo $name; ?>"><br>
                            <label>Expected Hours: </label><input class="form-control userInput moduleInput viewModule" type="number" name="hour" id="hour" min="1" max="999" value="<?php echo $hours; ?>"><br>
                            <label>Module Colour: <i class="fas fa-circle" id="theKeyColour"></i></label><input type="text" class="form-control" name="theColour" id="theColour" value="<?php echo $colour; ?>"><br><br>
                            <div id="colourPicker">
                                <button type="button" class="btn colourBtn"><i class="fas fa-circle fa-3x edit" id="blackC"></i></button>
                                <button type="button"  class="btn colourBtn"><i class="fas fa-circle fa-3x edit" id="redC"></i></button>
                                <button type="button"  class="btn colourBtn"><i class="fas fa-circle fa-3x edit" id="blueC"></i></button>
                                <button type="button"  class="btn colourBtn"><i class="fas fa-circle fa-3x edit" id="greenC"></i></button>
                                <button type="button"  class="btn colourBtn"><i class="fas fa-circle fa-3x edit" id="orangeC"></i></button>
                                <button type="button"  class="btn colourBtn"><i class="fas fa-circle fa-3x edit" id="purpleC"></i></button>
                                <button type="button"  class="btn colourBtn"><i class="fas fa-circle fa-3x edit" id="pinkC"></i></button>
                                <button type="button"  class="btn colourBtn"><i class="fas fa-circle fa-3x edit" id="yellowC"></i></button>
                            </div>

                            <p id="requiredMsg"></p>
                            <input type="submit" class="btn btn-primary submitBtn" name="saveModuleBtn" id="saveModuleBtn" value="Save Changes">
                        </form>

                    </div>
                </div>

            </div>
        </div>
    </div>

    <?php include_once 'ongoing_tasks.php';?>
    <script>
        $(function(){
            <?php $taskControl->sortTasks($_GET['code']); ?>
        });
    </script>

    <script src="../JQuery/complete_task.js"></script><!--IMPORT JQUERY TO MARK A TASK COMPLETE-->

</body>
</html>

<!-- UNABLE TO PLACE SCRIPT INTO A SEPARATE FILE TO RUN -->
<script>
    $(function(){
        //If user clicks on a task
        $(".taskBtn").click(function(){

            //Get the id of the task being viewed
            let theId = event.target.id;

            if(theId!=""){
                let xmlhttp = new XMLHttpRequest();
                //Wait for response
                xmlhttp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                        $("#details").html(this.responseText); //Output details of clicked task
                    }
                }

                //Send task id to retrieve details
                xmlhttp.open("GET","../Controller/create_task.php?taskId="+theId,true);
                xmlhttp.send();
            }
        });
    });
</script>