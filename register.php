<?php
session_start();
session_destroy();
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width"/>
    <link rel="icon" href="./images/tdt-logo.jpg" type="image/icon type"/>
    <title>Register</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous"/>

    <link rel="stylesheet" href="./style.css"/>
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

    <form id="idForm" action="./admin/sign_up.php" method="POST">
        <div class="form-group">
            <label for="input_full_name">Full Name</label>
            <input type="text" class="form-control" id="input_full_name" placeholder="Nguyen Tran Van A" required
                   name="full_name"/>
        </div>
        <div class="form-group">
            <label for="input_phone">Phone</label>
            <input type="text" class="form-control" id="input_phone" placeholder="083xxxxxxx" required name="phone"/>
        </div>

        <div class="form-group">
            <label for="input_birthday">Birthday</label>
            <input type="date" class="form-control" id="input_birthday" required name="birthday"/>
        </div>

        <div class="form-group">
            <label for="input_address">Address</label>
            <textarea class="form-control" id="input_address" required name="address" rows="2"></textarea>
        </div>

        <div class="form-group">
            <label for="input_email">Email</label>
            <input type="email" class="form-control" id="input_email" placeholder="52000668@student.tdtu.edu.vn"
                   required name="email"/>
        </div>

        <label for="">ID Card</label>
        <div class="row">
            <div class="col">
                <div class="form-group">
                    <div class="custom-file">
                        <input required name="front_image" type="file" class="form-control-file" id="input_front_image"
                               class="custom-file-input"/>
                        <label class="custom-file-label" for="input_front_image">Front ID Card</label>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="form-group">
                    <div class="custom-file">
                        <input required name="back_image" type="file" class="form-control-file" id="input_back_image"
                               class="custom-file-input"/>
                        <label class="custom-file-label" for="input_back_image">Back ID Card</label>
                    </div>
                </div>
            </div>
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-primary">
                Sign Up
            </button>
            <button type="reset" class="btn btn btn-outline-secondary btn-sm">
                Reset
            </button>
            <a role="button" class="btn btn btn-outline-secondary btn-sm" type="button" href="./login.php">
                Login
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
        //validate
        //^[A-Z][a-z]*(\s[A-Z][a-z]*)+$
        //^[A-ZÀÁÂÃÈÉÊÌÍÒÓÔÕÙÚĂĐĨŨƠƯĂẠẢẤẦẨẪẬẮẰẲẴẶẸẺẼỀỀỂỄỆỈỊỌỎỐỒỔỖỘỚỜỞỠỢỤỦỨỪỬỮỰỲỴÝỶỸ][a-zàáâãèéêìíòóôõùúăđĩũơưăạảấầẩẫậắằẳẵặẹẻẽềềểễệỉịọỏốồổỗộớờởỡợụủứừửữựỳỵýỷỹ]*(\s[A-ZÀÁÂÃÈÉÊÌÍÒÓÔÕÙÚĂĐĨŨƠƯĂẠẢẤẦẨẪẬẮẰẲẴẶẸẺẼỀỀỂỄỆỈỊỌỎỐỒỔỖỘỚỜỞỠỢỤỦỨỪỬỮỰỲỴÝỶỸ][a-zàáâãèéêìíòóôõùúăđĩũơưăạảấầẩẫậắằẳẵặẹẻẽềềểễệỉịọỏốồổỗộớờởỡợụủứừửữựỳỵýỷỹ]*)+$
        //\d
        //^[a-zA-Z0-9._%+-]+@\.student.tdtu.edu.vn$

        let nameRegex = /^[A-ZÀÁÂÃÈÉÊÌÍÒÓÔÕÙÚĂĐĨŨƠƯĂẠẢẤẦẨẪẬẮẰẲẴẶẸẺẼỀỀỂỄỆỈỊỌỎỐỒỔỖỘỚỜỞỠỢỤỦỨỪỬỮỰỲỴÝỶỸ][a-zàáâãèéêìíòóôõùúăđĩũơưăạảấầẩẫậắằẳẵặẹẻẽềềểễệỉịọỏốồổỗộớờởỡợụủứừửữựỳỵýỷỹ]*(\s[A-ZÀÁÂÃÈÉÊÌÍÒÓÔÕÙÚĂĐĨŨƠƯĂẠẢẤẦẨẪẬẮẰẲẴẶẸẺẼỀỀỂỄỆỈỊỌỎỐỒỔỖỘỚỜỞỠỢỤỦỨỪỬỮỰỲỴÝỶỸ][a-zàáâãèéêìíòóôõùúăđĩũơưăạảấầẩẫậắằẳẵặẹẻẽềềểễệỉịọỏốồổỗộớờởỡợụủứừửữựỳỵýỷỹ]*)+$/;
        if ($("input[name='full_name']").val().match(nameRegex) == null) {
            $(".toast-header > strong").html("Full name incorrect");
            $(".toast-body").html("Name must have at least 2 words<br>First character must be capitalized<br>Please enter again");
            $(".toast").toast("show");
            $("input[name='full_name']").focus();
        } else if (
            $("input[name='phone']")
                .val()
                .match(/^0\d{9}$/) == null ||
            $("input[name='phone']")
                .val()
                .match(/^0\d{9}$/) == false
        ) {
            $(".toast-header > strong").html("Phone incorrect");
            $(".toast-body").html("Requires 10-digit number and start-with 0<br> Please enter again");
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
                beforeSend: function () {
                },
                success: function (result) {
                    console.log(result);
                    console.log("success");
                    if (result.code === 200) {
                        $(".toast-header > strong").html("Register Success");
                        $(".toast-body").html(result.response);
                        $(".toast").toast("show");

                        setTimeout(() => window.location.assign("./registerSuccess.php"), 2000);
                    } else {
                        console.log(result.response);
                        $(".toast-header > strong").html("Register Fail");
                        $(".toast-body").html(result.response);
                        $(".toast").toast("show");
                    }
                },
                error: function (e) {
                    $(".toast-header > strong").html("Register Fail");
                    $(".toast-body").html(e.responseText);
                    $(".toast").toast("show");
                },
            });
        }
    });
</script>
</body>
</html>
