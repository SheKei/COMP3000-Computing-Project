<?php
include_once '../Controller/Module_Controller.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
    <style>
        #sideBar{
            margin-top: -5%;
            background-color: rgb(242, 242, 233);
        }
    </style>
</head>
<body>

<div id="sideBar" class="w3-sidebar w3-bar-block" style="width:20%; font-family: 'Century Gothic';">
    <br><br><br>
    <h3 class="w3-bar-item">Welcome</h3>
    <?php
        $controller = new Module_Controller("dummy");
        $controller->displaySideBar();
    ?>
    <a class="w3-bar-item w3-button" href="../View/home.php">Home</a>
</div>

</body>
</html>