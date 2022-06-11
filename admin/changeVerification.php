<?php
session_start();
header('Content-Type: application/json; charset=utf-8');

require_once('./configDB.php');

$isVerification = $_POST['isVerification'];
$user_id = $_SESSION['user_id'];
if ($_SESSION['username'] == 'admin') {
    $query = "
                UPDATE `users`
                SET isVerification = '$isVerification'
                WHERE id = $user_id";
    execute($query);

    die(json_encode(array('code' => 200, 'response' => 'Change status verification successful')));
} else {
    die(json_encode(array('code' => 400, 'response' => 'Change failed verification status')));
}
