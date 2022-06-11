<?php
session_start();
header('Content-Type: application/json; charset=utf-8');

require_once('./configDB.php');
require_once('./myMailer.php');

$username = $_SESSION['username'];
$phone_receiver = $_POST['phone'];
$sender_money = $_POST['sender_money'];
$fee = $_POST['fee'];
$message = $_POST['message'];
$fee_option = $_POST['fee_option'];
$full_name = getFullname($username);
$phone = getPhone($username);

if ($fee_option == 'option1') {
    if (getMoneyByUsername($username) < (int)$fee + (int)$sender_money) {
        die(json_encode(array('response' => 'Your account does not have enough money to sent', 'code' => 400)));
    }
    // sent
    sent($username, $phone_receiver, $sender_money, $fee, 0);
    die(json_encode(array('response' => 'Sent success', 'code' => 200)));
} else {
    if (getMoneyByUsername($username) < (int)$sender_money) {
        die(json_encode(array('response' => 'Your account does not have enough money to sent', 'code' => 400)));
    }
    // sent
    sent($username, $phone_receiver, $sender_money, 0, $fee);
    die(json_encode(array('response' => 'Sent success', 'code' => 200)));
}


