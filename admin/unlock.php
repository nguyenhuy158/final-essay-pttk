<?php
session_start();
header('Content-Type: application/json; charset=utf-8');

require_once('./configDB.php');


$user_id = $_SESSION['user_id'];
if ($_SESSION['username'] == 'admin') {
    $query = "UPDATE `users`
                SET wrong_time = '" . DEFAULT_TIME . "',
                    wrong_count = DEFAULT,
                    warming = DEFAULT
                WHERE id = '$user_id'";

    execute($query);

    die(json_encode(array('code' => 200, 'response' => 'Change status verification successful')));
} else {
    die(json_encode(array('code' => 400, 'response' => 'Change failed verification status')));
}
