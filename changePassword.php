<?php
session_start();
if (isset($_SESSION['username']) && $_SESSION['username'] == 'admin') {
    header('Location: admin.php');
} elseif (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
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
    <link rel="icon" href="./images/tdt-logo.jpg" type="image/icon type"/>
    <title>Change password</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous"/>

    <link rel="stylesheet" href="./style.css"
</head>
<body>
<!--toast-->
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

    <!--    handle form-->
    <form id="idForm" action="admin/changePassword.php" method="POST">
        <div class="form-group">
            <label for="input_current_password">Current Password</label>
            <input type="password" class="form-control" id="input_current_password" placeholder="Current Password"
                   name="current_password"/>
        </div>
        <div class="form-group">
            <label for="input_new_password">New Password</label>
            <input type="password" class="form-control" id="input_new_password" placeholder="New Password"
                   name="new_password"/>
        </div>
        <div class="form-group">
            <label for="input_config_new_password">Confirm New Password</label>
            <input type="password" class="form-control" id="input_config_new_password"
                   placeholder="Confirm New Password" name="config_new_password"/>
        </div>

        <!--        buttons-->
        <div class="form-group">
            <button type="submit" class="btn btn-primary">
                Change
            </button>
        </div>
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
        if ($("input[name='current_password']").val().length == 0) {
            $(".toast-header > strong").html("Password incorrect");
            $(".toast-body").html("Please enter current password");
            $(".toast").toast("show");
            $("input[name='current_password']").focus();
        } else if ($("input[name='new_password']").val().length < 6) {
            $(".toast-header > strong").html("New Password incorrect");
            $(".toast-body").html("New Password at least 6 characters<br>Please enter again");
            $(".toast").toast("show");
            $("input[name='new_password']").focus();
        } else if ($("input[name='new_password']").val() !== $("input[name='config_new_password']").val()) {
            $(".toast-header > strong").html("Confirm New Password incorrect");
            $(".toast-body").html("Confirm password do not match<br>Please enter again");
            $(".toast").toast("show");
            $("input[name='config_new_password']").focus();
        } else {
            let form = $(this);
            let actionUrl = form.attr("action");

            var $form = $("#idForm");
            var data = getFormData($form);

            $.ajax({
                type: "POST",
                url: actionUrl,
                data: form.serialize(),
                success: function (result) {
                    console.log(result);
                    if (result.code === 200) {
                        $(".toast-header > strong").html("Password changed");
                        $(".toast-body").html(result.response);
                        $(".toast").toast("show");

                        setTimeout(() => window.location.assign("./home.php"), 2000);
                    } else {
                        $(".toast-header > strong").html("Current password incorrect");
                        $(".toast-body").html(result.response);
                        $(".toast").toast("show");
                    }
                },
                error: function (e) {
                    $(".toast-header > strong").html("Change password fail");
                    $(".toast-body").html(e.responseText);
                    $(".toast").toast("show");
                },
            });
        }
    });
</script>
</body>
</html>
