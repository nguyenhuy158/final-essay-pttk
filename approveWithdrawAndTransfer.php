<?php
session_start();
if (!isset($_SESSION['username'])) {
    header('Location: login.php');
}

if (isset($_SESSION['username']) && $_SESSION['username'] == 'admin') {
    $username = $_SESSION['username'];
    require_once('./admin/configDB.php');
    $userInfo = getUserById($_SESSION['user_id']);
} elseif (isset($_SESSION['username'])) {
    header('Location: login.php');
} else {
    session_destroy();
    header('Location: login.php');
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" href="./images/tdt-logo.jpg" type="image/icon type">
    <title>Approve Withdraw and Transfer</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <link rel="stylesheet" href="./style.css"
</head>
<body>
<!--toast-->
<div aria-live="polite" aria-atomic="true" style="position: relative; ">
    <div class="toast" style="position: absolute; top: 1em; right: 1em;" data-autohide="true" data-delay="2000">
        <div class="toast-header">
            <strong class="mr-auto">Error</strong>
            <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="toast-body">
            This is a toast message.
        </div>
    </div>
</div>

<div class="container <?= require_once('background.php'); ?>">
    <!--    nav-->
    <?php
    require_once('nav.php');
    ?>


    <!--    feature -->
    <div class="row">
        <div class="col-md-8">

        </div>
        <div class="col-md-4">

            <div class="d-flex justify-content-between">
                <div>
                    <!--left empty-->
                </div>
                <div>
                    <div class="btn-group dropleft">
                        <button type="button" class="btn btn-primary dropdown-toggle dropdown-toggle-split"
                                data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                            <span class="sr-only">Toggle Dropdown</span>
                        </button>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="./userManagement.php">
                                User management
                            </a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="./logout.php">
                                Logout
                            </a>
                        </div>
                        <button type="button" class="btn btn-primary">
                            Task
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--    title-->
    <h1 class="text-center">Approve Withdraw and Transfer</h1>
    <div class="dropdown-divider"></div>

</div>

<script src="https://code.jquery.com/jquery-3.3.1.min.js"
        integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
        crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
        crossorigin="anonymous"></script>
<script src="./main.js"></script>

<script>
</script>
</body>
</html>
