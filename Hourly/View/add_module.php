<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="../JQuery/module_controller.js"></script>
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

    <div class="modal fade" id="moduleModal" style="font-family: "Century Gothic", "Century", "Century Schoolbook"">
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
                            <div class="container">
                                <div class="form-group row">

                                    <div class="col-2">
                                        <label>Module Code: <p id="codeChars"></p> </label>
                                    </div>
                                    <div class="col-10">
                                        <input class="form-control userInput moduleInput addModule" type="text" name="moduleCode"
                                               id="moduleCode" size="50" maxlength="50" required>
                                    </div>
                                </div>

                                <div class="form-group row">

                                    <div class="col-2">
                                        <label>Module Name: <p id="nameChars"></p> </label>
                                    </div>
                                    <div class="col-10">
                                        <input class="form-control userInput moduleInput addModule" type="text" name="moduleName"
                                               id="moduleName" maxlength="50" required>
                                    </div>
                                </div>

                                <div class="form-group row">

                                    <div class="col-2">
                                        <label>Module Colour: <i class="fas fa-circle" id="keyColour"></i></label>
                                        <input type="text" class="form-control" name="thisColour" id="thisColour"><br><br>
                                    </div>

                                    <div class="col-4">
                                        <div id="colourPicker">
                                            <button type="button"  class="btn colourBtn"><i class="fas fa-circle fa-3x" id="red"></i></button>
                                            <button type="button"  class="btn colourBtn"><i class="fas fa-circle fa-3x" id="blue"></i></button>
                                            <button type="button"  class="btn colourBtn"><i class="fas fa-circle fa-3x" id="green"></i></button>
                                            <button type="button"  class="btn colourBtn"><i class="fas fa-circle fa-3x" id="orange"></i></button>
                                            <button type="button"  class="btn colourBtn"><i class="fas fa-circle fa-3x" id="purple"></i></button>
                                            <button type="button"  class="btn colourBtn"><i class="fas fa-circle fa-3x" id="pink"></i></button>
                                            <button type="button"  class="btn colourBtn"><i class="fas fa-circle fa-3x" id="yellow"></i></button>
                                            <button type="button"  class="btn colourBtn"><i class="fas fa-circle fa-3x" id="black"></i></button>
                                        </div>
                                    </div>

                                    <div class="col-2">
                                        <label>Expected Hours: </label>
                                    </div>
                                    <div class="col-2">
                                        <input class="form-control moduleInput addModule" type="number" name="hours"
                                               id="hours" value="200" min="1" max="999" required>
                                    </div>
                                </div>

                            </div>


                        <p id="requiredMessage"></p>
                            <input style="font-size:20px" type="submit" class="btn btn-primary submitBtn float-right" name="addModuleBtn" id="addModuleBtn" disabled value="Add Module">
                        </form>

                    </div>
                </div>

            </div>
        </div>
    </div>

</body>
</html>


