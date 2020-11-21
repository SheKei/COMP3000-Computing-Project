<?php
include_once '../Controller/Module_Controller.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
</head>
<body>

<div class="w3-sidebar w3-light-grey w3-bar-block" style="width:20%;">
    <h3 class="w3-bar-item">Welcome</h3>
    <?php
        $controller = new Module_Controller("dummy");
        $controller->displaySideBar();
    ?>
</div>

</body>
</html>