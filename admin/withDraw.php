<?php
session_start();
header('Content-Type: application/json; charset=utf-8');

require_once('./configDB.php');

// username
$credit_id = $_POST['credit_id'];
$expiration_date = $_POST['expiration_date'];
$cvv_code = $_POST['cvv_code'];
$amount = $_POST['withdraw_money'];
$fee = $_POST['fee'];
$message = $_POST['message'];


if ($credit_id == '111111') {
    if ($expiration_date != '2022-10-10') {
        die(json_encode(array('response' => 'Invalid card information', 'code' => 400)));
    }
    if ($cvv_code != '411') {
        die(json_encode(array('response' => 'Invalid card information', 'code' => 400)));
    }

    $username = $_SESSION['username'];
    $userInfo = getUser($username);
    if ($userInfo['money'] < (int)$fee + (int)$amount) {
        die(json_encode(array('response' => 'Your account does not have enough money to withdraw', 'code' => 400)));
    }

    // withdraw
    withDraw($username, $amount, $fee);
    die(json_encode(array('response' => 'Withdraw success', 'code' => 200)));
}

die(json_encode(array('response' => 'This card is not supported for withdrawals', 'code' => 400)));
