<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width" />
    <link rel="icon" href="./images/tdt-logo.jpg" type="image/icon type" />
    <title>Forgot password</title>
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
    <form id="idForm" action="./admin/forgotPassword.php" method="POST">
        <div class="form-group">
            <label for="input_phone">Phone</label>
            <input type="text" class="form-control" id="input_phone" placeholder="083xxxxxxx" name="phone" required />
        </div>

        <div class="form-group">
            <label for="input_email">Email</label>
            <input type="email" class="form-control" id="input_email" placeholder="...@student.tdtu.edu.vn" name="email" required />
        </div>

        <!--        buttons-->
        <div class="form-group">
            <button type="submit" class="btn btn-primary">
                Get OTP
            </button>
            <a class="btn btn-outline-secondary btn-sm" type="button" href="./login.php">
                Login
            </a>
        </div>
    </form>
</div>

<script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<script src="./main.js"></script>
<script>
    $("#idForm").submit(function (e) {
        e.preventDefault();
        if (
            $("input[name='phone']")
                .val()
                .match(/^0\d{9}$/) == null ||
            $("input[name='phone']")
                .val()
                .match(/^0\d{9}$/) == false
        ) {
            $(".toast-header > strong").html("Phone incorrect");
            $(".toast-body").html("Requires 10-digit number<br> Please enter again");
            $(".toast").toast("show");
            $("input[name='phone']").focus();
        } else if (
            $("input[name='email']")
                .val()
                .match(/^[a-zA-Z0-9._%+-]+@student.tdtu.edu.vn$/g) == null
        ) {
            $(".toast-header > strong").html("Email incorrect");
            $(".toast-body").html(`Domain should '@student.tdtu.edu.vn'<br> Please enter again`);
            $(".toast").toast("show");
            $("input[name='email']").focus();
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
                beforeSend: function () {},
                success: function (result) {
                    console.log(result);
                    if (result.code === 200) {
                        $(".toast-header > strong").html("OTP sent success");
                        $(".toast-body").html(result.response);
                        $(".toast").toast("show");

                        setTimeout(() => window.location.assign("./configOTP.php"), 2000);
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
