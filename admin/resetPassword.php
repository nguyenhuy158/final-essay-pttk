<?php
session_start();
header('Content-Type: application/json; charset=utf-8');

require_once('./configDB.php');

require_once('./myMailer.php');

if ($_SERVER['REQUEST_METHOD'] != 'POST') {
    http_response_code(400);
    die(json_encode(array('code' => 400, 'message' => 'API only support POST request')));
}

$username = $_SESSION['username_forgot'];
$query = "SELECT * FROM `users` WHERE `username` = '$username'";

$userInfo = json_decode(json_encode(executeResult($query, true)), FALSE);
$phone = $userInfo->phone;
$full_name = $userInfo->full_name;
$password = $_POST['password'];

$query = "UPDATE `users` SET `password` = '" . md5(
        $phone . $full_name .
        $password
    ) . "', `isFirst` = '1' WHERE `username` = '$username'";

//echo $query;
$response = execute($query);

http_response_code(200);
die(json_encode(array('response' => $response ? 'Reset Success' : 'Reset fail', 'code' => 200)));
