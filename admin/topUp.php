<?php
session_start();
header('Content-Type: application/json; charset=utf-8');

require_once('./configDB.php');

// username
$credit_id = $_POST['credit_id'];
$expiration_date = $_POST['expiration_date'];
$cvv_code = $_POST['cvv_code'];
$amount = $_POST['top_up_money'];

$query = "
    SELECT * FROM credit_cards
    WHERE credit_id = '$credit_id'
";

$response = executeResult($query, true);
if (!is_null($response)) {
    if ($response['expiration_date'] != $expiration_date) {
        die(json_encode(array('response' => 'Wrong expiration date', 'code' => 400)));
    }
    if ($response['cvv_code'] != $cvv_code) {
        die(json_encode(array('response' => 'Wrong cvv code', 'code' => 400)));
    }

    // top up
    $username = $_SESSION['username'];
    if ($cvv_code == 444) {
        topUp($username, $amount, $response);
        die(json_encode(array('response' => 'Top up success', 'code' => 200)));
    }
    if ($cvv_code == 443) {
        if ($amount > 1000000) {
            die(json_encode(array('response' => 'The card can only be loaded up to 1 million/time', 'code' => 400)));
        }
        topUp($username, $amount, $response);
        die(json_encode(array('response' => 'Top up success', 'code' => 200)));
    }
    if ($cvv_code == 577) {
        die(json_encode(array('response' => 'The card is out of money', 'code' => 400)));
    }
}

die(json_encode(array('response' => 'This card is not supported', 'code' => 400)));
