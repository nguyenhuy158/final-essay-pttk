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
    <meta name="viewport" content="width=device-width"/>
    <link rel="icon" href="./images/tdt-logo.jpg" type="image/icon type"/>
    <title>Top up</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous"/>

    <link rel="stylesheet" href="./style.css"/>
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

    <form id="idForm" action="./admin/topUp.php" method="POST">
        <div class="form-group">
            <label for="input_credit_id">Credit ID</label>
            <input type="text" class="form-control" id="input_credit_id" placeholder="123xxx" name="credit_id"
                   required/>
        </div>

        <div class="row">
            <div class="col">
                <div class="form-group">
                    <label for="input_expiration_date">Expiration date</label>
                    <input type="date" class="form-control" id="input_expiration_date" name="expiration_date" required/>
                </div>
            </div>
            <div class="col">
                <div class="form-group">
                    <label for="input_cvv_code">CVV code</label>
                    <input type="text" class="form-control" id="input_cvv_code" placeholder="1xx" name="cvv_code"
                           required/>
                </div>
            </div>
        </div>

        <div class="form-group">
            <label for="input_top_up_money">Amount</label>
            <input type="number" class="form-control" id="input_top_up_money" placeholder="1,000" min="0"
                   name="top_up_money" required/>
        </div>

        <button type="submit" class="btn btn-primary">
            Top up
        </button>
    </form>
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
    $("#idForm").submit(function (e) {
        e.preventDefault();
        if ($("input[name='credit_id']").val().length != 6) {
            $(".toast-header > strong").html("Credit ID incorrect");
            $(".toast-body").html("Requires 6-digit number<br> Please enter again");
            $(".toast").toast("show");
            $("input[name='credit_id']").focus();
        } else if ($("input[name='cvv_code']").val().length != 3) {
            $(".toast-header > strong").html("CVV code incorrect");
            $(".toast-body").html(`Requires 3-digit number<br> Please enter again`);
            $(".toast").toast("show");
            $("input[name='cvv_code']").focus();
        } else if ($("input[name='top_up_money']").val() <= 0) {
            $(".toast-header > strong").html("Amount incorrect");
            $(".toast-body").html(`Requires greater than zero<br> Please enter again`);
            $(".toast").toast("show");
            $("input[name='top_up_money']").focus();
        } else {
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
                beforeSend: function () {
                },
                success: function (result) {
                    console.log(result);
                    if (result.code === 200) {
                        $(".toast-header > strong").html("OTP sent success");
                        $(".toast-body").html(result.response);
                        $(".toast").toast("show");

                        setTimeout(() => window.location.assign("./home.php"), 2000);
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
        }
    });
</script>
</body>
</html>
