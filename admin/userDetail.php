<?php
session_start();
header('Content-Type: application/json; charset=utf-8');

require_once('./configDB.php');

$user_id = $_POST['id'];
$_SESSION['user_id'] = $user_id;
if (isset($_SESSION['user_id'])) {

    die(json_encode(array('code' => 200, 'response' => 'Successfully retrieved user information')));
} else {
    die(json_encode(array('code' => 400, 'response' => 'Retrieving user information failed')));
}
