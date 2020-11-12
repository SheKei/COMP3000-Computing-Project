<?php
include_once '../Controller/module_controller.php';
include_once '../Controller/task_controller.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="../JQuery/complete_task.js"></script>
    <style>
        #heading, #buttonDisplay{
            margin-left: 20%;
        }

        #moduleCodeCurrent{display:none;}
    </style>
</head>
<body>
<?php
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
                //$code = $row['module_code']; FIX COLOUR ISSUE

                $controller->displayPageHeading($code, $name);

            }
        }

    }else{
        header('Location: home.php');
    }
?>

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
                        <form method="post" action="../Controller/edit_module.php">
                            <input class="form-control userInput moduleInput" type="text" name="moduleCodeCurrent" id="moduleCodeCurrent" maxlength="50" value="<?php echo $code; ?>"><br>
                            <label>Module Code: <p id="codeChars"></p> </label><input class="form-control userInput moduleInput" type="text" name="moduleCode" id="moduleCode" maxlength="50" value="<?php echo $code; ?>"><br>
                            <label>Module Name: <p id="nameChars"></p> </label><input class="form-control userInput moduleInput" type="text" name="moduleName" id="moduleName" maxlength="50" value="<?php echo $name; ?>"><br>
                            <label>Expected Hours: </label><input class="form-control moduleInput" type="number" name="hours" id="hours" min="1" max="999" value="<?php echo $hours; ?>"><br>
                            <label>Module Colour: <i class="fas fa-circle" id="keyColour"></i></label><input type="text" class="form-control" name="thisColour" id="thisColour"><br><br>
                            <div id="colourPicker">
                                <button type="button" class="btn colourBtn"><i class="fas fa-circle fa-3x" id="black"></i></button>
                                <button type="button"  class="btn colourBtn"><i class="fas fa-circle fa-3x" id="red"></i></button>
                                <button type="button"  class="btn colourBtn"><i class="fas fa-circle fa-3x" id="blue"></i></button>
                                <button type="button"  class="btn colourBtn"><i class="fas fa-circle fa-3x" id="green"></i></button>
                                <button type="button"  class="btn colourBtn"><i class="fas fa-circle fa-3x" id="orange"></i></button>
                                <button type="button"  class="btn colourBtn"><i class="fas fa-circle fa-3x" id="purple"></i></button>
                                <button type="button"  class="btn colourBtn"><i class="fas fa-circle fa-3x" id="pink"></i></button>
                                <button type="button"  class="btn colourBtn"><i class="fas fa-circle fa-3x" id="yellow"></i></button>
                            </div>

                            <p id="requiredMessage"></p>
                            <input type="submit" class="btn btn-primary" name="saveBtn" id="saveBtn" value="Save Changes">
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

</body>
</html>