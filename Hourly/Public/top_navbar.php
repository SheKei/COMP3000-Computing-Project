<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>

    <style>
        nav{
            padding: 15px;
        }
    </style>
</head>
<body>
        <nav class="fixed-top navbar-light bg-light">
            <ul class="nav justify-content-end">
                <li class="nav-item">
                    <button class="btn" data-toggle="modal" data-target="#moduleModal">Add Module</button>
                </li>
                <li class="nav-item">
                    <button class="btn" data-toggle="modal" data-target="#taskModal">Add Task</button>
                </li>
            </ul>
        </nav>

    <?php
    include_once "../View/add_module.php";
    include_once "../View/assign_task.php"
    ?>



</body>
</html>