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
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width" />
    <link rel="icon" href="./images/tdt-logo.jpg" type="image/icon type" />
    <title>Withdraw</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous" />

    <link rel="stylesheet" href="./style.css" />
</head>
<body>
<div aria-live="polite" aria-atomic="true" style="position: relative;">
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

    <form id="idForm" action="./admin/buyPhoneCard.php" method="POST">
        <div class="form-group">
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <label class="input-group-text" for="input_internet_provider">Internet Service Providers</label>
                </div>
                <select name="internet_provider" class="custom-select" id="input_internet_provider">
                    <option value="11111">Viettel</option>
                    <option value="22222">Mobifone</option>
                    <option value="33333">Vinaphone</option>
                </select>
            </div>
        </div>

        <div class="form-group">
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <label class="input-group-text" for="input_recharge_card">Recharge card</label>
                </div>
                <select name="recharge_card" class="custom-select" id="input_recharge_card">
                    <option value="10000">10,000</option>
                    <option value="20000">20,000</option>
                    <option value="50000">50,000</option>
                    <option value="100000">100,000</option>
                </select>
            </div>
        </div>

        <div class="form-group">
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <label class="input-group-text" for="input_amount">Amount</label>
                </div>
                <select name="amount" class="custom-select" id="input_amount">
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                </select>
            </div>
        </div>

        <div class="form-group">
            <label for="input_fee">Fee</label>
            <input type="number" class="form-control" id="input_fee" placeholder="0" min="0" name="fee" readonly />
        </div>

        <button type="submit" class="btn btn-primary">
            Buy
        </button>
    </form>
</div>

<script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<script src="./main.js"></script>
<script>
    $("#idForm").submit(function (e) {
        e.preventDefault();

        let form = $(this);
        let actionUrl = form.attr("action");

        var $form = $("#idForm");
        var data = getFormData($form);

        $.ajax({
            type: "POST",
            url: actionUrl,
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            beforeSend: function () {},
            success: function (result) {
                console.log(result);
                if (result.code === 200) {
                    $(".toast-header > strong").html("OTP sent success");
                    $(".toast-body").html(result.response);
                    $(".toast").toast("show");

                    setTimeout(() => window.location.assign("./buyPhoneCardSuccess.php"), 2000);
                } else {
                    $(".toast-header > strong").html("OTP sent fail");
                    $(".toast-body").html(result.response);
                    $(".toast").toast("show");
                }
            },
            error: function (e) {
                $(".toast-header > strong").html("OTP sent fail");
                $(".toast-body").html(e.responseText);
                $(".toast").toast("show");
            },
        });
    });
</script>
</body>
</html>
