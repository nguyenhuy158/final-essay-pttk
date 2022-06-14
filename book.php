<?php
//header('location: login.php');
session_start();
require_once('./admin/configDB.php');
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width"/>
    <link rel="icon" href="./images/tdt-logo.jpg" type="image/icon type"/>
    <title>Detail</title>
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
    <!--    nav-->
    <?php

    echo "
        <div class='row pb-3'>
            <div class='col'>
                <div class='d-flex justify-content-between'>
                    <div>
                    </div>
                    <div>
                        <a class='btn btn-outline-secondary btn-sm' type='button' href='./index.php'>
                            Home
                        </a>
                    </div>
                </div>
            </div>
        </div>
    ";
    ?>

    <!--    welcome-->
    <div class="row">
        <div class="col">
            <p class="h1">
                Welcome
                <?php
                if (isset($_SESSION['username'])) {
                    $username = $_SESSION['username'];
                    echo getFullname($username);
                }
                ?>
            </p>
        </div>
    </div>


    <!--    films-->
    <?php
    $films = getFilmById($_GET['id_films']);

    echo "<div class='row mt-3'>";
    for ($i = 0; $i < count($films); $i++) {
        if ($i != 0 && $i % 3 == 0) {
            echo "</div>";
            echo "<div class='row mt-3'>";
        }
        echo "
            <div class='col-sm '>
                <div class='card' style='width: 19rem;'>
                    <img src='./images/" . $films[$i]['cover'] . "' class='card-img-top' alt='...'>
                    <div class='card-body'>
                        <h5 class='card-title'>" . $films[$i]['name'] . "</h5>
                        
                    </div>
                </div>
            </div>
            
            <div class='col-sm d-flex align-items-stretch'>
                <p class='card-text h3'>
                    Number of empty seats: " . getCurrentSpaceById($films[$i]['id']) . "
                </p>
            </div>
            <div class='col-sm d-flex align-items-stretch'>
                <p class='card-text h3'>
                    Price: " . formatMoney(getPriceById($films[$i]['id'])) . " VND
                </p>
            </div>
        ";
    }
    echo "</div>";

    echo "<div class='row mt-3'>";
    for ($i = 1; $i <= getSpaceById($films[0]['id']); $i++) {
        if ($i != 1 && $i % 10 == 1) {
            echo "</div>";
            echo "<div class='row'>";
        }
        if (spaceAble($films[0]['id'], $i) != '1') {
            echo "<div class='col px-1'>
                    <form action='./bookConfig.php' method='post'>
                        <input type='hidden' name='id_films' value='" . $_GET['id_films'] . "' >
                        <input type='hidden' name='space' value='" . $i . "' >
                        <button type='submit' class='btn btn-outline-primary w-100'>$i</button> </div>
                    </form>";
        } else {
            echo "<div class='col px-1'>
                    <form action='./bookConfig.php' method='post'>
                        <input type='hidden' name='id_films' value='" . $_GET['id_films'] . "' >
                        <input type='hidden' name='space' value='" . $i . "' >
                        <button type='submit' class='btn btn-secondary w-100' disabled>$i</button> </div>
                    </form>";
        }

    }
    echo "</div>";

    echo "<div class='row m-3'>";
    echo "<div class='col'><button class='btn btn-outline-primary w-100' disabled>available</button></div>";
    echo "<div class='col'><button class='btn btn-secondary w-100' disabled>not available</button></div>";
    echo "</div>";
    ?>
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
    $("form").submit(function (e) {
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
            beforeSend: function () {
            },
            success: function (result) {
                console.log(result);
                console.log("success");
                if (result.code === 200) {
                    $(".toast-header > strong").html("Book film Success");
                    $(".toast-body").html(result.response);
                    $(".toast").toast("show");

                    setTimeout(() => window.location.assign("./index.php"), 2000);
                } else {
                    $(".toast-header > strong").html("Book film Fail");
                    $(".toast-body").html(result.response);
                    $(".toast").toast("show");
                }
            },
            error: function (e) {
                $(".toast-header > strong").html("Book film Fail");
                $(".toast-body").html(e.responseText);
                $(".toast").toast("show");
            },
        });
    });
</script>
</body>
</html>
