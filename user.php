<?php
session_start();
require_once('./admin/configDB.php');
if (!isset($_SESSION['username'])) {
    header('Location: login.php');
}

if (isset($_SESSION['username']) && $_SESSION['username'] == 'admin') {
    $username = $_SESSION['username'];
    $userInfo = getUserById($_SESSION['user_id']);
} elseif (isset($_SESSION['username'])) {
    header('Location: login.php');
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

<!-- Modal verification-->
<div class="modal fade" id="modalVerification" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Do you want to continue?</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Change</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal unlock-->
<div class="modal fade" id="modalUnlock" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Do you want to unlock?</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                User unlock <b><i><?= $userInfo['full_name'] ?></i></b>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Unlock</button>
            </div>
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

    <!--    id card-->
    <div class="row">
        <div class="col-12 mx-auto">
            <div class="text-center">
                <img src="./images/<?= getSrcBackImageById($_SESSION['user_id']) ?>" alt="" width="300" height="200"
                     class="rounded">
                <img src="./images/<?= getSrcFrontImageById($_SESSION['user_id']) ?>" alt="" width="300" height="200"
                     class="rounded">
            </div>
            <div class="text-center">
                <span>front image</span>
                <span>back image</span>
            </div>
        </div>
    </div>

    <!--    full name and verification-->
    <div class="row">
        <div class="col-12 mx-auto my-3">
            <div class="text-center">
                <h3>
                    Username: <?= $userInfo['username'] ?>
                </h3>

                <div class="btn-group">
                    <button type="button" class="btn btn-sm bg-white">
                        <?php
                        if ($userInfo['isVerification'] == 0) {
                            echo '<span class="badge badge-warning">Not verified</span>';
                        } elseif ($userInfo['isVerification'] == 1) {
                            echo '<span class="badge badge-secondary">Waiting</span>';
                        } elseif ($userInfo['isVerification'] == 2) {
                            echo '<span class="badge badge-danger">Cancel</span>';
                        } else {
                            echo '<span class="badge badge-success">Verified</span>';
                        }
                        ?>
                    </button>
                    <button type="button" class="btn btn-sm
                             <?php
                    if ($userInfo['isVerification'] == 0) {
                        echo 'btn-warning';
                    } elseif ($userInfo['isVerification'] == 1) {
                        echo 'btn-secondary';
                    } elseif ($userInfo['isVerification'] == 2) {
                        echo 'btn-danger';
                    } else {
                        echo 'btn-success';
                    }
                    ?>
                             dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Action
                    </button>
                    <div class="dropdown-menu">
                        <!--                        <button class='dropdown-item text-white bg-warning' type='submit'>Not verified</button>-->
                        <?php
                        if ($userInfo['isVerification'] != 0) {
                            echo "
                                        <form class='form_verification_0' action='./admin/changeVerification.php' method='post'>
                                            <input type='hidden' name='isVerification' data-text='" . verification2Text(0) . "' value='0'>
                                            <button type='button' class='dropdown-item text-white bg-warning' data-toggle='modal' data-target='#modalVerification'>
                                                Not verified
                                            </button>
                                        </form>
                                    ";
                        } else {
                            echo "
                                        <form class='form_verification_0' action='./admin/changeVerification.php' method='post'>
                                            <input type='hidden' name='isVerification' data-text='" . verification2Text(0) . "' value='0'>
                                            <button disabled type='button' class='dropdown-item text-white bg-warning' data-toggle='modal' data-target='#modalVerification'>
                                                Not verified
                                            </button>
                                        </form>
                                    ";
                        }
                        if ($userInfo['isVerification'] != 1) {
                            echo "
                                        <form class='form_verification_1' action='./admin/changeVerification.php' method='post'>
                                            <input type='hidden' name='isVerification' data-text='" . verification2Text(1) . "' value='1'>
                                            <button type='button' class='dropdown-item text-white bg-secondary' data-toggle='modal' data-target='#modalVerification'>
                                                Waiting
                                            </button>
                                        </form>
                                    ";
                        } else {
                            echo "
                                        <form class='form_verification_1' action='./admin/changeVerification.php' method='post'>
                                            <input type='hidden' name='isVerification' data-text='" . verification2Text(1) . "' value='1'>
                                            <button disabled type='button' class='dropdown-item text-white bg-secondary' data-toggle='modal' data-target='#modalVerification'>
                                                Waiting
                                            </button>
                                        </form>
                                    ";
                        }
                        if ($userInfo['isVerification'] != 2) {
                            echo "
                                        <form class='form_verification_2' action='./admin/changeVerification.php' method='post'>
                                            <input type='hidden' name='isVerification' data-text='" . verification2Text(2) . "' value='2'>
                                            <button type='button' class='dropdown-item text-white bg-danger' data-toggle='modal' data-target='#modalVerification'>
                                                Cancel
                                            </button>
                                        </form>
                                    ";
                        } else {
                            echo "
                                        <form class='form_verification_2' action='./admin/changeVerification.php' method='post'>
                                            <input type='hidden' name='isVerification' data-text='" . verification2Text(2) . "' value='2'>
                                            <button disabled type='button' class='dropdown-item text-white bg-danger' data-toggle='modal' data-target='#modalVerification'>
                                                Cancel
                                            </button>
                                        </form>
                                    ";
                        }
                        if ($userInfo['isVerification'] != 3) {
                            echo "
                                        <form class='form_verification_3' action='./admin/changeVerification.php' method='post'>
                                            <input type='hidden' name='isVerification' data-text='" . verification2Text(3) . "' value='3'>
                                            <button type='button' class='dropdown-item text-white bg-success' data-toggle='modal' data-target='#modalVerification'>
                                                Verified
                                            </button>
                                        </form>
                                    ";
                        } else {
                            echo "
                                        <form class='form_verification_3' action='./admin/changeVerification.php' method='post'>
                                            <input type='hidden' name='isVerification' data-text='" . verification2Text(3) . "' value='3'>
                                            <button disabled type='button' class='dropdown-item text-white bg-success' data-toggle='modal' data-target='#modalVerification'>
                                                Verified
                                            </button>
                                        </form>
                                    ";
                        }
                        ?>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!--    unlock if exits-->
    <!--    <button type='submit' class='btn btn-sm btn-success'>Unlock</button>-->
    <?php
    if (isTemporarilyLocked($userInfo['username'])) {
        echo "
                <div class='row'>
                    <div class='col-8 mx-auto'>
                        <h5 class='text-center'>
                            Locked time: " . $userInfo['wrong_time'] . " 
                        </h5>
                    </div>
                    <div class='col-8 mx-auto'>
                        <div class='text-center'>
                            <form class='unlock' action='./admin/unlock.php' method='post'>
                                <!--                <input type='hidden' name=''-->
                                <button type='button' class='btn btn-sm btn-success' data-toggle='modal' data-target='#modalUnlock'>
                                    Unlock
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
                ";
    }
    ?>

    <!--    info-->
    <div class="dropdown-divider"></div>
    <div class="row">
        <div class="col">
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <h4>
                        ID:
                    </h4>
                </div>
                <div>
                            <span>
                               <?= $userInfo['id'] ?>
                            </span>
                </div>
            </div>
        </div>
    </div>
    <div class="dropdown-divider"></div>
    <div class="row">
        <div class="col">
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <h4>
                        Amount:
                    </h4>
                </div>
                <div>
                            <span>
                               <?= getMoney($userInfo['username']); ?> VND
                            </span>
                </div>
            </div>
        </div>
    </div>
    <div class="dropdown-divider"></div>
    <div class="row">
        <div class="col">
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <h4>
                        Full name:
                    </h4>
                </div>
                <div>
                            <span>
                                <?= $userInfo['full_name'] ?>
                            </span>
                </div>
            </div>
        </div>
    </div>
    <div class="dropdown-divider"></div>
    <div class="row">
        <div class="col">
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <h4>
                        Email:
                    </h4>
                </div>
                <div>
                            <span>
                                <?= $userInfo['email'] ?>
                            </span>
                </div>
            </div>
        </div>
    </div>
    <div class="dropdown-divider"></div>
    <div class="row">
        <div class="col">
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <h4>
                        Phone:
                    </h4>
                </div>
                <div>
                            <span>
                                <?= $userInfo['phone'] ?>
                            </span>
                </div>
            </div>
        </div>
    </div>
    <div class="dropdown-divider"></div>
    <div class="row">
        <div class="col">
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <h4>
                        Birthday:
                    </h4>
                </div>
                <div>
                            <span>
                                <?= $userInfo['birthday'] ?>
                            </span>
                </div>
            </div>
        </div>
    </div>
    <div class="dropdown-divider"></div>
    <div class="row">
        <div class="col">
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <h4>
                        Address:
                    </h4>
                </div>
                <div>
                            <span>
                                <?= $userInfo['address'] ?>
                            </span>
                </div>
            </div>
        </div>
    </div>

    <!--    purchase history-->
    <div class="dropdown-divider"></div>
    <div class="row py-3">
        <div class="col table-responsive">
            <table class="table table-hover table-striped">
                <thead>
                <tr class="table-primary">
                    <th scope="col">Purchase code</th>
                    <th scope="col">Date created</th>
                    <th scope="col">Type</th>
                    <th scope="col">Sender</th>
                    <th scope="col">Receiver</th>
                    <th scope="col">Amount</th>
                    <th scope="col">Fee</th>
                    <th scope="col">Message</th>
                    <th scope="col">Internet service provider</th>
                    <th scope="col">Recharge card</th>
                    <th scope="col">Card code</th>
                </tr>
                </thead>
                <tbody>
                <?php
                $purchases = getPurchases($userInfo['id']);
                if (empty($purchases)) {
                    echo "
                                        <tr>
                                            <th scope='col' colspan=''>No data</th>
                                        </tr>";
                } else {

                    for ($i = 0; $i < count($purchases); $i++) {
                        echo "
                                    <tr>
                                        <th scope='col'>" . $purchases[$i]['id'] . "</th>
                                        <th scope='col'>" . $purchases[$i]['create_at'] . "</th>
                                        <th scope='col'>" . purchasesType2Text($purchases[$i]['type']) . "</th>
                                        <th scope='col'>" . getFullnameById($purchases[$i]['user_root']) . "</th>
                                        <th scope='col'>" . getFullnameById($purchases[$i]['user_des']) . "</th>
                                        <th scope='col'>" . $purchases[$i]['money'] . "</th>
                                        <th scope='col'>" . $purchases[$i]['fee'] . "</th>
                                        <th scope='col'>" . $purchases[$i]['message'] . "</th>
                                        <th scope='col'>" . $purchases[$i]['internet_provider'] . "</th>
                                        <th scope='col'>" . $purchases[$i]['recharge_card'] . "</th>
                                        <th scope='col'>" . $purchases[$i]['card_code'] . "</th>
                                    </tr>";
                    }
                }
                ?>
                </tbody>
            </table>
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
