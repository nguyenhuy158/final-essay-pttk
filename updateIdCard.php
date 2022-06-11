<?php
session_start();
if (!isset($_SESSION['username'])) {
    header('Location: login.php');
} else {
//    print_r($_SESSION);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"/>
    <meta
            name="viewport"
            content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0"
    />
    <meta
            http-equiv="X-UA-Compatible"
            content="ie=edge"
    />
    <link rel="icon" href="./images/tdt-logo.jpg" type="image/icon type">
    <title>Change your ID Card</title>
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

    <form
            id="idForm"
            action="./admin/updateIdCard.php"
            method="POST"
    >
        <div class="row">
            <div class="col">
                <div class="form-group">
                    <div class="custom-file">
                        <input
                                required
                                name="front_image"
                                type="file"
                                class="form-control-file"
                                id="input_front_image"
                                class="custom-file-input"
                        >
                        <label class="custom-file-label" for="input_front_image">Front ID Card</label>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="form-group">
                    <div class="custom-file">
                        <input
                                required
                                name="back_image"
                                type="file"
                                class="form-control-file"
                                id="input_back_image"
                                class="custom-file-input"
                        >
                        <label class="custom-file-label" for="input_back_image">Back ID Card</label>
                    </div>
                </div>
            </div>
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-primary">
                Change
            </button>
            <button type="reset" class="btn btn btn-outline-secondary btn-sm">
                Reset
            </button>
            <a class="btn btn-outline-secondary btn-sm" type="button" href="./logout.php">
                Logout
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
        let form = $(this);
        let actionUrl = form.attr('action');

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
                    $('.toast-header > strong').html('ID card changed');
                    $('.toast-body').html(result.response);
                    $('.toast').toast('show');

                    setTimeout(() => window.location.assign("./home.php"), 2000);
                } else {
                    $('.toast-header > strong').html('ID card change fail');
                    $('.toast-body').html(result.response);
                    $('.toast').toast('show');
                }
            },
            error: function (e) {
                $('.toast-header > strong').html('ID card change fail');
                $('.toast-body').html(e.responseText);
                $('.toast').toast('show');
            }
        });
    });
</script>
</body>
</html>
