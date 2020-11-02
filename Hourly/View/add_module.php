<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
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
                        <label>Module Code: </label><input class="form-control" type="text" id="moduleCode"><br>
                        <label>Module Name: </label><input class="form-control" type="text" id="moduleName"><br>
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


