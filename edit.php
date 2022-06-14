<?php
session_start();
require_once('./admin/configDB.php');
if (!isset($_SESSION['username'])) {
    header('Location: login.php');
}

if (isset($_SESSION['username']) && $_SESSION['username'] == 'admin') {
//    $username = $_SESSION['username'];
} elseif (isset($_SESSION['username'])) {
    header('Location: index.php');
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
    <link rel="icon" href="./images/tdt-logo.jpg" type="image/icon type">
    <title>Home</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

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

    <!--    welcome to name-->
    <div class="row">
        <div class="col">
            <p class="h1 text-center">
                Welcome,
                <?= getFullname($_SESSION['username']) ?>
            </p>
        </div>
    </div>

    <!--    feature -->
    <div class="row">
        <div class="col-md-8">

        </div>
        <div class="col-md-4">

            <div class="d-flex justify-content-between">
                <div>
                    <!--left empty-->
                </div>
                <div>
                    <div class="btn-group dropleft">
                        <button type="button" class="btn btn-primary dropdown-toggle dropdown-toggle-split"
                                data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                            <span class="sr-only">Toggle Dropdown</span>
                        </button>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="./userManagement.php">
                                User management
                            </a>

                            <a class="dropdown-item" href="./addFilm.php">
                                Add film
                            </a>

                            <a class="dropdown-item" href="./editFilm.php">
                                Edit film
                            </a>

                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="./logout.php">
                                Logout
                            </a>
                        </div>
                        <button type="button" class="btn btn-primary">
                            Task
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--    form add-->
    <form id="idForm" action="./admin/edit.php" method="POST" enctype="multipart/form-data">
        <div class="row">
            <div class="col">
                <input name="id_films" value="<?= $_GET['id_films'] ?>" type="hidden"/>

                <div class="form-group">
                    <label for="input_name_film">Name of film: </label>
                    <input type="text" class="form-control" id="input_name_film" required
                           name="name_film" autocomplete="off" value="<?= getNameById($_GET['id_films']) ?>"/>
                </div>

                <div class="form-group">
                    <div class="custom-file">
                        <input name="cover" type="file" class="form-control-file" id="input_cover"
                               class="custom-file-input"
                               accept="image/*"/>
                        <label class="custom-file-label" for="input_cover">New cover</label>
                    </div>
                </div>

                <div class="form-group">
                    <label for="input_description">Description: </label>
                    <textarea class="form-control" id="input_description" required name="description"
                              rows="5"><?= getDescriptionById($_GET['id_films']) ?></textarea>
                </div>
            </div>
            <div class="col">
                <div class="form-group">
                    <img class="p-4 w-100 rounded" src="./images/<?= getCoverById($_GET['id_films']) ?>" alt="">
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col">
                <div class="form-group">
                    <label for="input_price">Price:</label>
                    <input type="number" class="form-control" id="input_price"
                           value="<?= getPriceById($_GET['id_films']) ?>" step="1000"
                           required name="price"/>
                </div>
            </div>
            <div class="col">
                <div class="form-group">
                    <div class="form-group">
                        <label for="input_space">Space:</label>
                        <input type="number" class="form-control" id="input_space"
                               value="<?= getSpaceById($_GET['id_films']) ?>" step="1"
                               required name="space"/>
                    </div>
                </div>
            </div>
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-primary">
                Edit
            </button>
            <button type="reset" class="btn btn btn-outline-secondary btn-sm">
                Reset
            </button>
        </div>
    </form>
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
    $("#idForm").submit(function (e) {
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
                    $(".toast-header > strong").html("Add film Success");
                    $(".toast-body").html(result.response);
                    $(".toast").toast("show");

                    setTimeout(() => window.location.assign("./admin.php"), 2000);
                } else {
                    console.log(result.response);
                    $(".toast-header > strong").html("Add film Fail");
                    $(".toast-body").html(result.response);
                    $(".toast").toast("show");
                }
            },
            error: function (e) {
                $(".toast-header > strong").html("Add film Fail");
                $(".toast-body").html(e.responseText);
                $(".toast").toast("show");
                    console.log(e.responseText);
            },
        });
    });
</script>
</body>
</html>
