<!DOCTYPE html>
<html lang="en">
<head>
    <title>Timetable</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <style>
        h4, label{
            font-family: "Century Gothic", "Century", "Century Schoolbook";
        }

        .hidden{
            display: none;
        }

    </style>
</head>
<body>

<?php
include_once '../Public/top_navbar.php';
include_once '../Public/side_navbar.php';
?>

<div class="modal fade" id="viewClass">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">

            <div class="modal-body">
                <div class="container">
                    <!--FORM TO VIEW CLASS DETAILS-->
                    <section id="classSection">
                        <p id="classDetails"></p>
                    </section>
                </div>
            </div>

        </div>
    </div>
</div>

</body>
</html>


