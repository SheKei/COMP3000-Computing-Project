<?php
include_once '../Controller/Module_Controller.php';
$controller = new Module_Controller("dummy");

if(isset($_GET['code']))
{
    $module = $controller->displayModulePage($_GET['code']); //Get module details to display as heading
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
    <script src="../JQuery/module_controller.js"></script>
    <script src="../JQuery/validating_input.js"></script>

    <style>
        #theKeyColour{color: <?php echo $module->getColour(); ?>}
    </style>
</head>
<body>

<div class="modal fade" id="viewModule">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">

            <div class="modal-header">
                <h4 class="modal-title"><?php echo $module->getModuleCode()." - ".$module->getModuleName(); ?></h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <div class="modal-body">
                <div class="container" id="moduleContainer">
                    <!-- Form to create module -->
                    <form method="post" action="../Controller/moduleController.php">
                        <input class="form-control userInput moduleInput" type="text" name="moduleCodeCurrent" id="moduleCodeCurrent" maxlength="50" value="<?php echo $module->getModuleCode(); ?>"><br>
                        <label>Module Code: <p id="editCodeChars"></p> </label><input class="form-control userInput moduleInput viewModule" type="text" name="code" id="code" maxlength="50" value="<?php echo $module->getModuleCode(); ?>"><br>
                        <label>Module Name: <p id="editNameChars"></p> </label><input class="form-control userInput moduleInput viewModule" type="text" name="name" id="name" maxlength="50" value="<?php echo $module->getModuleName(); ?>"><br>
                        <label>Expected Hours: </label><input class="form-control userInput moduleInput viewModule" type="number" name="hour" id="hour" min="1" max="999" value="<?php echo $module->getExpectedHours(); ?>"><br>
                        <label>Module Colour: <i class="fas fa-circle" id="theKeyColour"></i></label><input type="text" class="form-control" name="theColour" id="theColour" value="<?php echo $module->getColour(); ?>"><br><br>
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

</body>
</html>