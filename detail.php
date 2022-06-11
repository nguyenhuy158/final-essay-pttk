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
                    <img src='./images/" . $films[$i]['image'] . "' class='card-img-top' alt='...'>
                    <div class='card-body'>
                        <h5 class='card-title'>" . $films[$i]['name'] . "</h5>
                        
                    </div>
                </div>
            </div>
            
            <div class='col-sm d-flex align-items-stretch'>
                <p class='card-text h3'>
                    " . $films[$i]['description'] . "
                </p>
            </div>
        ";
    }
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

</script>
</body>
</html>
