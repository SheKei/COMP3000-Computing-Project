<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script src="../JQuery/add_module.js"></script>
    <script src="../JQuery/validating_input.js"></script>
    <style>
        #blue, #blueC{color:#0E86D4;}
        #pink, #pinkC{color:#FFAEBC;}
        #green, #greenC{color:#B4F8C8;}
        #purple, #purpleC{color:#C26DBC;}
        #yellow, #yellowC{color:#F8EA8C;}
        #orange, #orangeC{color:#FF9636;}
        #red, #redC{color:#FF5C4D;}

        #thisColour{display: none;}
    </style>
</head>
<body>

    <div class="modal fade" id="moduleModal">
        <div class="modal-dialog modal-dialog-centered modal-xl">
            <div class="modal-content">

                <div class="modal-header">
                    <h4 class="modal-title">Create a Module</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <div class="modal-body">
                    <div class="container" id="moduleContainer">

                        <!-- Form to create module -->
                        <form method="post" action="../Controller/moduleController.php">
                        <label>Module Code: <p id="codeChars"></p> </label><input class="form-control userInput moduleInput addModule" type="text" name="moduleCode" id="moduleCode" maxlength="50"><br>
                        <label>Module Name: <p id="nameChars"></p> </label><input class="form-control userInput moduleInput addModule" type="text" name="moduleName" id="moduleName" maxlength="50"><br>
                        <label>Expected Hours: </label><input class="form-control moduleInput addModule" type="number" name="hours" id="hours" value="200" min="1" max="999"><br>
                        <label>Module Colour: <i class="fas fa-circle" id="keyColour"></i></label><input type="text" class="form-control" name="thisColour" id="thisColour"><br><br>
                            <div id="colourPicker">
                                <button type="button"  class="btn colourBtn"><i class="fas fa-circle fa-3x" id="red"></i></button>
                                <button type="button"  class="btn colourBtn"><i class="fas fa-circle fa-3x" id="blue"></i></button>
                                <button type="button"  class="btn colourBtn"><i class="fas fa-circle fa-3x" id="green"></i></button>
                                <button type="button"  class="btn colourBtn"><i class="fas fa-circle fa-3x" id="orange"></i></button>
                                <button type="button"  class="btn colourBtn"><i class="fas fa-circle fa-3x" id="purple"></i></button>
                                <button type="button"  class="btn colourBtn"><i class="fas fa-circle fa-3x" id="pink"></i></button>
                                <button type="button"  class="btn colourBtn"><i class="fas fa-circle fa-3x" id="yellow"></i></button>
                            </div>
                        <p id="requiredMessage"></p>
                            <input type="submit" class="btn btn-primary submitBtn" name="addModuleBtn" id="addModuleBtn" disabled value="Add Module">
                        </form>

                    </div>
                </div>

            </div>
        </div>
    </div>

</body>
</html>


