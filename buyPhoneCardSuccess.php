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
<html>
<head>
    <meta charset="utf-8"/>
    <meta
            name="viewport"
            content="width=device-width"
    />
    <link rel="icon" href="./images/tdt-logo.jpg" type="image/icon type">
    <title>Phone Card</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <link rel="stylesheet" href="./style.css">
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

    <div class="row">
        <div class="col">
            <p class="h1 text-center">List of phone card codes</p>
        </div>
    </div>

    <table class="table table-striped">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Internet Service Providers</th>
            <th scope="col">Recharge card</th>
            <th scope="col">Card code</th>
        </tr>
        </thead>
        <tbody>
        <?php
        $card_codes = $_SESSION['card_codes'];
        for ($i = 0; $i < count($card_codes); $i++) {
            echo "
            <tr>
                <th scope='row'>$i</th>
                <td>" . $card_codes[$i]['internet_provider'] . "</td>
                <td>" . formatMoney($card_codes[$i]['recharge_card']) . "</td>
                <td>" . $card_codes[$i]['card_code'] . "</td>
            </tr>
            ";
        }
        ?>
        </tbody>
    </table>

    <div class="row">
        <div class="col">
            <p class="text-center">
                You can also review these phone card codes in the <a href="./purchaseDetail.php" target="">purchase
                    details</a> in the
                <a href="./purchase.php" target="">Purchase</a> history section.
            </p>
            <p class="text-center">
                <a class="" href="./logout.php" target="">Logout now</a>
            </p>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <p class="text-right">
            </p>
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
