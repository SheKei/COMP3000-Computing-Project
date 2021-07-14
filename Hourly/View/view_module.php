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
    <script src="https://kit.fontawesome.com/20c7401107.js" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="../JQuery/complete_task.js"></script>
    <script src="../JQuery/module_controller.js"></script>
    <script src="../JQuery/validating_input.js"></script>

    <style>
        #theKeyColour{color: <?php echo $module->getColour(); ?>;}

        #deleteModule{margin-left: auto;}

        .title{margin-left: 15px;}

        .moduleColor{
            background-color: <?php echo $module->getColour();?>;
            color: <?php
                //If module is not color coded as black, print text in black else in white
                if($module->getColour() != "rgb(51, 57, 64)"){
                    echo "black";
                }else{
                    echo "white";
                }
            ?>;
        }

        .category{
            background-color: white;
            color: black;
        }

        #heading{font-size: 25px; font-family: "Century Gothic", "Century", "Century Schoolbook"}

    </style>
</head>
<body>

<div class="modal fade" id="viewModule">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">

            <div class="modal-header" >
                <h4 class="modal-title"><?php echo $module->getModuleCode()." - ".$module->getModuleName(); ?></h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <div class="modal-body">
                <div class="container" id="moduleContainer">
                    <!-- Form to create module -->
                    <form method="post" action="../Controller/moduleController.php">
                        <input class="form-control userInput moduleInput" type="text" name="moduleCodeCurrent" id="moduleCodeCurrent" maxlength="50" value="<?php echo $module->getModuleCode(); ?>"><br>
                        <label><p id="errorMsg"></p>Module Code: <p id="editCodeChars"></p> </label><input class="form-control userInput moduleInput viewModule" type="text" name="code" id="code" maxlength="50" value="<?php echo $module->getModuleCode(); ?>"><br>
                        <label>Module Name: <p id="editNameChars"></p> </label><input class="form-control userInput moduleInput viewModule" type="text" name="name" id="name" maxlength="50" value="<?php echo $module->getModuleName(); ?>"><br>
                        <label>Expected Hours: </label><input class="form-control userInput moduleInput viewModule" type="number" name="hour" id="hour" min="1" max="999" value="<?php echo $module->getExpectedHours(); ?>"><br>

                        <label>Module Colour: <i class="fas fa-circle" id="theKeyColour"></i></label>
                        <input type="text" class="form-control" name="theColour" style="display: none" id="theColour" value="<?php echo $module->getColour(); ?>">

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
                        <br><br>
                        <div class="row">
                            <input type="submit" class="btn btn-success submitBtn" name="saveModuleBtn" id="saveModuleBtn" value="Save Changes">
                            <button type="button" class="btn btn-danger" id="deleteModule" name="deleteModule" data-toggle="modal" data-target="#deleteModuleWarning">Delete Module</button>
                        </div>
                    </form>

                    <?php include_once 'delete_module.php';?> <!-- IMPORT CONFIRMATION POP UP PAGE TO DELETE MODULE -->
                </div>
            </div>

        </div>
    </div>
</div>

</body>
</html>
<script>
    let existModules= [<?php echo $controller->getListOfExistingModules() ?>] ;
    let currentCode = <?php echo '"'.$module->getModuleCode().'"'?>;
    $(function(){

        //Check if module code already exists
        $("#code").on('keyup', function(){
            let currentModuleInput = $("#code").val();
            for (let i = 0; i < existModules.length; i++) {
                if(currentModuleInput == existModules[i]){ //If found a matched element

                    if(currentModuleInput != currentCode){//if the matched element is not current code
                        $("#errorMsg").html("Module "+ currentModuleInput + " already exists!");
                        $("#saveModuleBtn").prop("disabled", true);
                        break; //STOP FOR LOOP IF FOUND SAME ELEMENT
                    }
                }else{
                    $("#errorMsg").html("");
                    $("#saveModuleBtn").prop("disabled", false);
                }
            }
        });
    });
</script>