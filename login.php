<?php
session_start();
if (isset($_SESSION['username'])) {
    header('Location: home.php');
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
    <title>Login</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <link rel="stylesheet" href="./style.css">
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

    <!--    form-->
    <form id="idForm" action="admin/sign_in.php" method="POST">
        <div class="form-group">
            <label for="input_username">Username</label>
            <input type="text" class="form-control" id="input_username" aria-describedby="emailHelp"
                   placeholder="Username" name="username"/>
        </div>
        <div class="form-group">
            <label for="input_password">Password</label>
            <input type="password" class="form-control" id="input_password" placeholder="Password"
                   name="password"/>
        </div>

        <!--        buttons-->
        <div class="form-group">
            <button type="submit" class="btn btn-primary">
                Login
            </button>
            <a class="btn btn-outline-secondary btn-sm" type="button" href="register.php">
                Register
            </a>
            <a class="btn btn-outline-secondary btn-sm" type="button" href="./forgotPassword.php">
                Forgot password
            </a>
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
        if ($("input[name='username']").val().length === 0) {
            $('.toast-header > strong').html('Username incorrect');
            $('.toast-body').html('Username is empty<br>Please enter again');
            $('.toast').toast('show');
            $("input[name='username']").focus();
        } else if ($("input[name='password']").val().length === 0) {
            $('.toast-header > strong').html('Password incorrect');
            $('.toast-body').html('Password is empty<br>Please enter again');
            $('.toast').toast('show');
            $("input[name='password']").focus();
        } else {
            let form = $(this);
            let actionUrl = form.attr("action");

            let $form = $("#idForm");
            let data = getFormData($form);

            $.ajax({
                type: "POST",
                url: actionUrl,
                data: JSON.stringify(data),
                success: function (result) {
                    console.log(result);
                    if (result.code === 200) {
                        $('.toast-header > strong').html('Login Success');
                        $('.toast-body').html(result.response);
                        $('.toast').toast('show');

                        setTimeout(() => window.location.assign("./index.php"), 2000);
                    } else {
                        $('.toast-header > strong').html('Login Fail');
                        $('.toast-body').html(result.response);
                        $('.toast').toast('show');
                    }
                },
                error: function (e) {
                    $('.toast-header > strong').html('Login Fail');
                    $('.toast-body').html(e.responseText);
                    $('.toast').toast('show');
                },
            });
        }
    });
</script>
</body>
</html>
