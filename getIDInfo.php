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
        <div class="col-md-8"></div>
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

    <!--    id card-->
    <div class="row">
        <div class="col-12 mx-auto">
            <div class="text-center">
                <img src="./images/<?= getSrcBackImage($username) ?>" alt="" width="300" height="200"
                     class="rounded">
                <img src="./images/<?= getSrcFrontImage($username) ?>" alt="" width="300" height="200"
                     class="rounded">
            </div>
            <div class="text-center">
                <span>front image</span>
                <span>back image</span>
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

    $('button[data-target="#modalVerification"]').click(function (e) {
        let button_id = $(this).parent().find('input').attr('value');
        let status = $(this).parent().find('input').attr('data-text');
        $('#modalVerification .modal-body').html(`The user's status will change to <strong>${status}</strong>`);
        $('#modalVerification').attr('data-button-id', button_id);
        $('#modalVerification').modal('show');
    });
    $('#modalVerification button:contains("Change")').click(function (e) {
        console.log('Change');
        let button_id = $('#modalVerification').attr('data-button-id');
        $(`form.form_verification_${button_id}`).submit();
        $('#modalVerification').modal('hide');
    })

    $('button[data-target="#modalUnlock"]').click(function (e) {
        $('#modalUnlock').modal('show');
    });
    $('#modalUnlock button:contains("Unlock")').click(function (e) {
        console.log('Unlock');
        $("form.unlock").submit();
        $('#modalUnlock').modal('hide');
    })
    $("form.form_verification_0").submit(function (e) {
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
                    $('.toast-header > strong').html('Success');
                    $('.toast-body').html(result.response);
                    $('.toast').toast('show');

                    setTimeout(() => window.location.assign("./user.php"), 2000);
                } else {
                    console.log(result.response);
                    $('.toast-header > strong').html('Fail');
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
    $("form.form_verification_1").submit(function (e) {
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
                    $('.toast-header > strong').html('Success');
                    $('.toast-body').html(result.response);
                    $('.toast').toast('show');

                    setTimeout(() => window.location.assign("./user.php"), 2000);
                } else {
                    console.log(result.response);
                    $('.toast-header > strong').html('Fail');
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
    $("form.form_verification_2").submit(function (e) {
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
                    $('.toast-header > strong').html('Success');
                    $('.toast-body').html(result.response);
                    $('.toast').toast('show');

                    setTimeout(() => window.location.assign("./user.php"), 2000);
                } else {
                    console.log(result.response);
                    $('.toast-header > strong').html('Fail');
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
    $("form.form_verification_3").submit(function (e) {
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
                    $('.toast-header > strong').html('Success');
                    $('.toast-body').html(result.response);
                    $('.toast').toast('show');

                    setTimeout(() => window.location.assign("./user.php"), 2000);
                } else {
                    console.log(result.response);
                    $('.toast-header > strong').html('Fail');
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
    $("form.unlock").submit(function (e) {
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
                    $('.toast-header > strong').html('Success');
                    $('.toast-body').html(result.response);
                    $('.toast').toast('show');

                    setTimeout(() => window.location.assign("./user.php"), 2000);
                } else {
                    console.log(result.response);
                    $('.toast-header > strong').html('Fail');
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
