<?php
session_start();
header('Content-Type: application/json; charset=utf-8');

require_once('./configDB.php');


$input = json_decode(file_get_contents('php://input'));
$input = (array)$input;

$receiver_phone = $input['receiver_phone'];
$full_name = getFullnameByPhone($receiver_phone);

die(json_encode(array('code' => 200, 'response' => 'Get full name success', 'full_name' => $full_name)));
