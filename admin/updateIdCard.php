<?php
session_start();
header('Content-Type: application/json; charset=utf-8');

require_once('./configDB.php');
require_once('./myMailer.php');

// username
$username = $_SESSION['username'];
// file
$path = '../images/'; // upload directory

$front_image = $_FILES['front_image']['name'];
$front_image_tmp = $_FILES['front_image']['tmp_name'];
$back_image = $_FILES['back_image']['name'];
$back_image_tmp = $_FILES['back_image']['tmp_name'];
//print_r($_FILES);

$ext1 = strtolower(pathinfo($front_image, PATHINFO_EXTENSION));
$ext2 = strtolower(pathinfo($back_image, PATHINFO_EXTENSION));

$filename = tempnam($path, 'front-image');
move_uploaded_file($front_image_tmp, $filename . '.' . $ext1);
unlink($filename);
$front_image = basename($filename . '.' . $ext1);

$filename = tempnam($path, 'back-image');
move_uploaded_file($back_image_tmp, $filename . '.' . $ext2);
unlink($filename);
$back_image = basename($filename . '.' . $ext2);

$query = "UPDATE users 
            SET front_image = '$front_image', back_image = '$back_image', isVerification = '0' 
            WHERE username = '$username'";

$response = execute($query);

if ($response['response'] == 'success') {
    die(json_encode(array('response' => 'Changed Success', 'code' => 200)));
} else {
    die(json_encode(array('response' => 'Changed Fail', 'code' => 400)));
}

