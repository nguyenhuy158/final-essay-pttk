<?php
session_start();
header('Content-Type: application/json; charset=utf-8');

require_once('./configDB.php');

if ($_SERVER['REQUEST_METHOD'] != 'POST') {
    http_response_code(405);
    die(json_encode(array('code' => 4, 'message' => 'API only support POST request')));
}

//print_r($_POST);
//print_r($_SESSION);
$username = $_SESSION['username'];
$current_password = $_POST['current_password'];
$new_password = $_POST['new_password'];

$query = "SELECT * FROM `users` WHERE username = '$username'";
$userInfo = json_decode(json_encode(executeResult($query, true)), FALSE);
$password = $userInfo->password;
$phone = $userInfo->phone;
$full_name = $userInfo->full_name;

if (md5(
        $phone . $full_name .
        $current_password
    ) == $password) {
    $query = "UPDATE `users`
        SET password = '" . md5(
            $userInfo->phone .
            $userInfo->full_name .
            $new_password
        ) . "'
    WHERE username = '$username'";

    execute($query);
    die(json_encode(array('response' => 'Password changed', 'code' => 200)));
} else {
    die(json_encode(array('response' => 'Password incorrect', 'code' => 400)));
}
