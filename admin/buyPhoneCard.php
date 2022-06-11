<?php
session_start();
header('Content-Type: application/json; charset=utf-8');

require_once('./configDB.php');

// username
$internet_provider = $_POST['internet_provider'];
$recharge_card = $_POST['recharge_card'];
$amount = $_POST['amount'];
$fee = $_POST['fee'];

$username = $_SESSION['username'];
$userInfo = getUser($username);
if ($userInfo['money'] < (int)$amount * (int)$recharge_card) {
    die(json_encode(array('response' => 'Your account does not have enough money to buy card<br>Please try another option', 'code' => 400)));
}

// withdraw
buyCard($username, $internet_provider, $recharge_card, $amount);
die(json_encode(array('response' => 'Buy phone card success', 'code' => 200)));