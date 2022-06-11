<?php
session_start();
require_once('./admin/configDB.php');

if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
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
    <title>Profile</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <link rel="stylesheet" href="./style.css"
</head>
<body>

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

    <!--    welcome-->
    <div class="row">
        <div class="col-12 mx-auto">
            <div class="text-center">
                <img src="./images/tdt-logo.jpg" alt="" width="100" class="rounded-circle">
            </div>
        </div>
        <div class="col-12 mx-auto my-1">
            <div class="text-center">
                <h3>
                    <?= getFullname($username) ?>
                </h3>

                <?php
                if (getIsVerification($username) == 0) {
                    echo '<span class="badge badge-warning">Not verified</span>';
                } elseif (getIsVerification($username) == 1) {
                    echo '<span class="badge badge-secondary">Waiting</span>';
                } elseif (getIsVerification($username) == 2) {
                    echo '<span class="badge badge-danger">Cancel</span>';
                } else {
                    echo '<span class="badge badge-success">Verified</span>';
                }
                ?>
            </div>
        </div>
    </div>

    <!--    feature -->
    <div class="row">
        <div class="col-md-8">
            <div class="h-100 d-flex align-items-center justify-content-between">
                <div class="money">
                    Amount: <?= getMoney($username); ?> VND
                </div>
            </div>
        </div>
        <div class="col-md-4">

            <div class="d-flex justify-content-between">
                <div>
                    <!--left empty-->
                </div>
                <div>
                    <div class="btn-group">
                        <button type="button" class="btn btn-primary">
                            Account
                        </button>
                        <button type="button" class="btn btn-primary dropdown-toggle dropdown-toggle-split"
                                data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                            <span class="sr-only">Toggle Dropdown</span>
                        </button>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="./getIDInfo.php">
                                My image ID
                            </a>
                            <?php
                            if (getIsVerification($username) == 1) {
                                echo "<a class='dropdown-item' href='./updateIdCard.php'>
                                        Update ID Card
                                    </a>";
                            }

                            // verified
                            if (getIsVerification($username) == 3) {
                                echo "<a class='dropdown-item bg-light' href='./topUp.php'>
                                        Top up
                                    </a>";
                                echo "<a class='dropdown-item bg-light' href='./withDraw.php'>
                                        Withdraw
                                    </a>";
                                echo "<a class='dropdown-item bg-light' href='./transfer.php'>
                                        Transfer
                                    </a>";
                                echo "<a class='dropdown-item bg-light' href='./buyPhoneCard.php'>
                                        Buy phone card
                                    </a>";
                            }
                            ?>
                            <a class="dropdown-item" href="./changePassword.php">
                                Change password
                            </a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="./logout.php">
                                Logout
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--        info-->
    <div class="dropdown-divider"></div>
    <div class="row">
        <div class="col">
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <h4>
                        Email:
                    </h4>
                </div>
                <div>
                    <span>
                        <?= getEmail($username); ?>
                    </span>
                </div>
            </div>
        </div>
    </div>
    <div class="dropdown-divider"></div>
    <div class="row">
        <div class="col">
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <h4>
                        Phone:
                    </h4>
                </div>
                <div>
                    <span>
                        <?= getPhone($username) ?>
                    </span>
                </div>
            </div>
        </div>
    </div>
    <div class="dropdown-divider"></div>
    <div class="row">
        <div class="col">
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <h4>
                        Birthday:
                    </h4>
                </div>
                <div>
                    <span>
                        <?= getBirthday($username) ?>
                    </span>
                </div>
            </div>
        </div>
    </div>
    <div class="dropdown-divider"></div>
    <div class="row">
        <div class="col">
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <h4>
                        Address:
                    </h4>
                </div>
                <div>
                    <span>
                        <?= getAddress($username) ?>
                    </span>
                </div>
            </div>
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
</script>
</body>
</html>
