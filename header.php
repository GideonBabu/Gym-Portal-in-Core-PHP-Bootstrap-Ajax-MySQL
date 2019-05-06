<?php
require_once('lib/dbconnect.php');
require_once('lib/constants.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="shortcut icon" type="image/png" href="public/images/favicon.png">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="public/css/bootstrap.min.css">    
    <!-- Custom CSS-->
    <link rel="stylesheet" href="public/css/app.css">
    <link rel="stylesheet" href="public/css/jquery-ui.min.css">
    <script src="public/js/jquery.js"></script>
    <script src="public/js/jquery-ui.min.js"></script>

    <!-- Popper.js Bootstrap JS -->
    <script src="public/js/popper.min.js"></script>
    <script src="public/js/bootstrap.min.js"></script>
    <script src="public/js/app.js"></script>
    <title>Virtuagym Sample App</title>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light navbar-default">
        <div class="container">
            <a href="/virtuagym/" class="logo">Virtuagym</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive"
                aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="btn btn-primary btn-default" href="/virtuagym">Workout Plans</a>
                    </li>
                    &nbsp;
                    <li class="nav-item">
                        <a href="workout-plan.php?action=add" class='btn btn-primary'>Add New Workout Plan</a>
                    </li>
                    &nbsp;
                    <li class="nav-item">
                        <a class="btn btn-primary btn-default" href="users.php">Users</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- Modal -->
    <div id="preview-modal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body" id="workout-plan-body"></div>
            </div>

        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col">