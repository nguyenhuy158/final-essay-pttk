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
    <title>Transfer</title>
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

    <form id="idForm" action="./admin/transfer.php" method="POST">
        <div class="form-group">
            <label for="input_phone">Phone</label>
            <input type="text" class="form-control" id="input_phone" placeholder="083xxxxxxx" name="phone"
                   required/>
        </div>

        <div class="form-group">
            <input readonly type="text" class="form-control" id="user_name"
                   required/>
        </div>

        <div class="row">
            <div class="col">
                <div class="form-group">
                    <label for="input_sender_money">Amount</label>
                    <input type="number" class="form-control" id="input_sender_money" placeholder="1000" min="0"
                           name="sender_money" required/>
                </div>
            </div>
            <div class="col-4">
                <div class="form-group">
                    <label for="input_fee">Fee</label>
                    <input type="number" class="form-control" id="input_fee" placeholder="0" min="0" name="fee"
                           readonly/>
                </div>
            </div>
        </div>

        <div class="form-group">
            <label for="input_message">Message</label>
            <textarea class="form-control" id="input_message" name="message" rows="2"></textarea>
        </div>

        <div class="form-group">
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="fee_option" id="input_sender_fee"
                       value="option1" checked>
                <label class="form-check-label" for="input_sender_fee">The sender bears the fee</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="fee_option" id="input_receiver_fee"
                       value="option2">
                <label class="form-check-label" for="input_receiver_fee">The receiver bears the fee</label>
            </div>
        </div>

        <button type="submit" class="btn btn-primary">
            Sent
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
    $("input[name='phone']").keyup(function (e) {
        $.ajax({
            type: "POST",
            url: './admin/getFullname.php',
            data: JSON.stringify({'receiver_phone': $("input[name='phone']").val()}),
            contentType: false,
            cache: false,
            processData: false,
            beforeSend: function () {
            },
            success: function (result) {
                $('#user_name').val(result['full_name']);
            },
            error: function (e) {
            },
        });
    });
    $("input[name='sender_money']").keyup(function (e) {
        $("input[name='fee']").val(Math.round(parseInt($("input[name='sender_money']").val()) * 0.05));
    });
    $("input[name='sender_money']").change(function (e) {
        $("input[name='fee']").val(Math.round(parseInt($("input[name='sender_money']").val()) * 0.05));
    });

    $("#idForm").submit(function (e) {
        e.preventDefault();
        if ($("input[name='phone']")
                .val()
                .match(/^0\d{9}$/) == null ||
            $("input[name='phone']")
                .val()
                .match(/^0\d{9}$/) == false) {
            $(".toast-header > strong").html("Credit ID incorrect");
            $(".toast-body").html("Requires 6-digit number<br> Please enter again");
            $(".toast").toast("show");
            $("input[name='phone']").focus();
        } else if ($("input[name='sender_money']").val() == 0) {
            $(".toast-header > strong").html("CVV code incorrect");
            $(".toast-body").html(`Requires 3-digit number<br> Please enter again`);
            $(".toast").toast("show");
            $("input[name='sender_money']").focus();
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
                        $(".toast-header > strong").html("Success");
                        $(".toast-body").html(result.response);
                        $(".toast").toast("show");

                        setTimeout(() => window.location.assign("./home.php"), 2000);
                    } else {
                        $(".toast-header > strong").html("Fail");
                        $(".toast-body").html(result.response);
                        $(".toast").toast("show");
                    }
                },
                error: function (e) {
                    $(".toast-header > strong").html("Fail");
                    $(".toast-body").html(e.responseText);
                    $(".toast").toast("show");
                },
            });
        }
    });
</script>
</body>
</html>
