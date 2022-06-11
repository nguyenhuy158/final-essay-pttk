<?php
session_start();
if (!isset($_SESSION['username'])) {
    header('Location: login.php');
}

if (isset($_SESSION['username']) && $_SESSION['username'] == 'admin') {
    $username = $_SESSION['username'];
    require_once('./admin/configDB.php');
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
    <title>User management</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T"
          crossorigin="anonymous">

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
                            <a class="dropdown-item" href="./approveWithdrawAndTransfer.php">
                                Approve withdrawals and transfers
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
    <h1 class="text-center">User management</h1>
    <div class="dropdown-divider"></div>

    <!--    getList1: of accounts waiting for activation-->
    <h4>List of accounts waiting for activation</h4>
    <div class="row py-3">
        <div class="col">
            <table class="table table-hover">
                <thead>
                <tr class="table-primary">
                    <th scope="col">ID</th>
                    <th scope="col">Username</th>
                    <th scope="col">Type</th>
                    <th scope="col">Date</th>
                    <th scope="col">Details</th>
                </tr>
                </thead>
                <tbody>
                <?php
                $users = getList1();

                for ($i = 0; $i < count($users); $i++) {
                    echo "
                    <tr class='" . getClassRow($users[$i]['isVerification']) . "'>
                        <th scope='col'>" . $users[$i]['id'] . "</th>
                        <th scope='col'>" . $users[$i]['username'] . "</th>
                        <th scope='col'>" . verification2Text($users[$i]['isVerification']) . "</th>
                        <th scope='col'>" . $users[$i]['create_at'] . "</th>
                        <th scope='col'>
                            <form action='./admin/userDetail.php' method='POST'>
                                <input type='hidden' name='id' value='" . $users[$i]['id'] . "' >
                                <button class='btn btn-info w-100' type='submit'>go</button>
                            </form> 
                        </th>
                    </tr>
                    ";
                }

                ?>
                </tbody>
            </table>
        </div>
    </div>

    <div class="dropdown-divider"></div>
    <h4>List of activated accounts</h4>
    <!--    getList2 of activated accounts-->
    <div class="row py-3">
        <div class="col">
            <table class="table table-hover table-striped">
                <thead>
                <tr class="table-success">
                    <th scope="col">ID</th>
                    <th scope="col">Username</th>
                    <th scope="col">Date created</th>
                    <th scope="col">Details</th>
                </tr>
                </thead>
                <tbody>
                <?php

                $users = getList2();
                for ($i = 0; $i < count($users); $i++) {
                    echo "
                    <tr>
                        <th scope='col'>" . $users[$i]['id'] . "</th>
                        <th scope='col'>" . $users[$i]['username'] . "</th>
                        <th scope='col'>" . $users[$i]['create_at'] . "</th>
                        <th scope='col'>
                            <form action='./admin/userDetail.php' method='POST'>
                                <input type='hidden' name='id' value='" . $users[$i]['id'] . "' >
                                <button class='btn btn-info w-100' type='submit'>go</button>
                            </form> 
                        </th>
                    </tr>
                    ";
                }

                ?>
                </tbody>
            </table>
        </div>
    </div>

    <div class="dropdown-divider"></div>
    <h4>List of accounts that have been disabled (due to not agreeing to activate)</h4>
    <!--    getList3 of accounts that have been disabled (due to not agreeing to activate)-->
    <div class="row py-3">
        <div class="col">
            <table class="table table-hover table-striped">
                <thead>
                <tr class="table-warning">
                    <th scope="col">ID</th>
                    <th scope="col">Username</th>
                    <th scope="col">Date created</th>
                    <th scope="col">Details</th>
                </tr>
                </thead>
                <tbody>
                <?php
                $users = getList3();
                for ($i = 0; $i < count($users); $i++) {
                    echo "
                    <tr>
                        <th scope='col'>" . $users[$i]['id'] . "</th>
                        <th scope='col'>" . $users[$i]['username'] . "</th>
                        <th scope='col'>" . $users[$i]['create_at'] . "</th>
                        <th scope='col'>
                            <form action='./admin/userDetail.php' method='POST'>
                                <input type='hidden' name='id' value='" . $users[$i]['id'] . "' >
                                <button class='btn btn-info w-100' type='submit'>go</button>
                            </form> 
                        </th>
                    </tr>
                    ";
                }

                ?>
                </tbody>
            </table>
        </div>
    </div>

    <div class="dropdown-divider"></div>
    <h4>List of accounts that are locked indefinitely (due to incorrect login many times)</h4>
    <!--    getList4 of accounts that are locked indefinitely (due to incorrect login many times)-->
    <div class="row py-3">
        <div class="col">
            <table class="table table-hover table-striped">
                <thead>
                <tr class="table-danger">
                    <th scope="col">ID</th>
                    <th scope="col">Username</th>
                    <th scope="col">Locked time</th>
                    <th scope="col">Details</th>
                </tr>
                </thead>
                <tbody>
                <?php
                $users = getList4();

                for ($i = 0; $i < count($users); $i++) {
                    echo "
                    <tr>
                        <th scope='col'>" . $users[$i]['id'] . "</th>
                        <th scope='col'>" . $users[$i]['username'] . "</th>
                        <th scope='col'>" . $users[$i]['wrong_time'] . "</th>
                        <th scope='col'>
                            <form action='./admin/userDetail.php' method='POST'>
                                <input type='hidden' name='id' value='" . $users[$i]['id'] . "' >
                                <button class='btn btn-info w-100' type='submit'>go</button>
                            </form> 
                        </th>
                    </tr>
                    ";
                }

                ?>
                </tbody>
            </table>
        </div>
    </div>
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
    $("form").submit(function (e) {
        e.preventDefault(); 

        let form = $(this);
        let actionUrl = form.attr("action");

        $.ajax({
            type: "POST",
            url: actionUrl,
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            beforeSend: function () {

            },
            success: function (result) {
                console.log(result)
                console.log('success');
                if (result.code === 200) {
                    $('.toast-header > strong').html('Register Success');
                    $('.toast-body').html(result.response);
                    $('.toast').toast('show');

                    setTimeout(() => window.location.assign("./user.php"), 2000);
                } else {
                    console.log(result.response);
                    $('.toast-header > strong').html('Register Fail');
                    $('.toast-body').html(result.response);
                    $('.toast').toast('show');
                }

            },
            error: function (e) {
                $('.toast-header > strong').html('Register Fail');
                $('.toast-body').html(e.responseText);
                $('.toast').toast('show');
            }
        });
    });
</script>
</body>
</html>
