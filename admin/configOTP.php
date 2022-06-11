<?php
session_start();
header('Content-Type: application/json; charset=utf-8');

require_once('./configDB.php');


$otp = $_POST['otp'];
//print_r($_SESSION);
$username = $_SESSION['username_forgot'];

$query = "SELECT * FROM users WHERE username = '$username'";

$userInfo = executeResult($query, true);

if (isset($userInfo)) {
    if (dateDifference(date("Y-m-d h:i:s"), $userInfo['otp_time']) > 1) {
        die(json_encode(array('response' => 'OTP is no longer valid (more than 1 minute)', 'code' => 400)));
    } else if (otpCorrect($otp, $userInfo)) {
        setIsFirst($userInfo);
        die(json_encode(array('response' => 'OTP correct', 'code' => 200)));
    }
}
die(json_encode(array('response' => 'OTP fail', 'code' => 400)));
