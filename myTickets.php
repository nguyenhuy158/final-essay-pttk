<?php
session_start();
require_once('./admin/configDB.php');
if (isset($_SESSION['username']) && $_SESSION['username'] == 'admin') {
    header('Location: admin.php');
} elseif (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
    if (firstVisit($username) == 0) {
        header('Location: resetPassword.php');
    }
} else {
    session_destroy();
    header('Location: login.php');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
    <link rel="icon" href="./images/tdt-logo.jpg" type="image/icon type">
    <title>Home</title>

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
        <div class="col">
            <p class="h1">
                Welcome,
                <?= getFullname($username) ?>
            </p>
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
                            <a class="dropdown-item" href="./getProfile.php">
                                Profile
                            </a>
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

    <div class="row">

        <?php
        $myTickets = getMyTicketsByUsername($_SESSION['username']);
        if (count($myTickets) == 0) {
            echo "
            <div class='col'>
                <p class='w-100'>No ticket</p>
            </div>
            ";
        } else {
            echo "<div class='col'>
            <table class='table table-hover table-striped'>
                <thead>
                <tr class='table-primary'>
                    <th scope='col'>Name of film</th>
                    <th scope='col'>Space</th>
                    <th scope='col'>Details of film</th>
                </tr>
                </thead>
                <tbody>
                ";
            for ($i = 0; $i < count($myTickets); $i++) {
                echo "
                    <tr>
                        <th scope='col'>" . getNameById($myTickets[$i]['film_id']) . "</th>
                        <th scope='col'>" . $myTickets[$i]['space'] . "</th>
                        <th scope='col'>
                            <form action='./detail.php' method='get'>
                                <input type='hidden' name='id_films' value='" . $myTickets[$i]['film_id'] . "' >
                                <button type='submit' class='btn-block btn btn-secondary'>go</button>
                            </form>
                        </th>
                    </tr>
                    ";
            }
            echo "</tbody>
                </table>
                ";
        }
        ?>
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
