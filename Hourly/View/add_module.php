<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <script src="../JQuery/add_module.js"></script>
    <script src="../JQuery/validating_input.js"></script>
    <style>
        #blue{color:#0E86D4;}
        #pink{color:#FFAEBC;}
        #green{color:#B4F8C8;}
        #purple{color:#C26DBC;}
        #yellow{color:#F8EA8C;}
        #orange{color:#FF9636;}
        #red{color:#FF5C4D;}
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
                        <label>Module Code: <p id="codeChars"></p> </label><input class="form-control userInput" type="text" id="moduleCode" maxlength="50"><br>
                        <label>Module Name: <p id="nameChars"></p> </label><input class="form-control userInput" type="text" id="moduleName" maxlength="50"><br>
                        <label>Expected Hours: </label><input class="form-control" type="number" id="hours"><br>
                        <label>Module Colour: <i class="fas fa-circle" id="keyColour"></i> </label><br><br>

                        <div id="colourPicker">
                            <button class="btn colourBtn"><i class="fas fa-circle fa-3x" id="black"></i></button>
                            <button class="btn colourBtn"><i class="fas fa-circle fa-3x" id="red"></i></button>
                            <button class="btn colourBtn"><i class="fas fa-circle fa-3x" id="blue"></i></button>
                            <button class="btn colourBtn"><i class="fas fa-circle fa-3x" id="green"></i></button>
                            <button class="btn colourBtn"><i class="fas fa-circle fa-3x" id="orange"></i></button>
                            <button class="btn colourBtn"><i class="fas fa-circle fa-3x" id="purple"></i></button>
                            <button class="btn colourBtn"><i class="fas fa-circle fa-3x" id="pink"></i></button>
                            <button class="btn colourBtn"><i class="fas fa-circle fa-3x" id="yellow"></i></button>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-primary">Add Module</button>
                </div>

            </div>
        </div>
    </div>

</body>
</html>


