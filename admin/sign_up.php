<?php
session_start();
header('Content-Type: application/json; charset=utf-8');

include_once('./configDB.php');
include_once('./myMailer.php');

//if ($_SERVER['REQUEST_METHOD'] != 'POST') {
//    http_response_code(405);
//    die(json_encode(array('code' => 4, 'message' => 'API only support POST request')));
//}
//
//$input = json_decode(file_get_contents('php://input'));

//if (is_null($input)) {
//    die(json_encode(array('code' => 2, 'message' => 'Only support Json format')));
//}
//
//if (!property_exists($input, 'phone') ||
//    !property_exists($input, 'email') ||
//    !property_exists($input, 'full_name') ||
//    !property_exists($input, 'birthday') ||
//    !property_exists($input, 'address') ||
//    !property_exists($input, 'front_image') ||
//    !property_exists($input, 'back_image')
//) {
//    http_response_code(400);
//    die(json_encode(array('code' => 1, 'message' => 'Missing parameter')));
//}
//
//if (empty($input->phone) ||
//    empty($input->email) ||
//    empty($input->full_name) ||
//    empty($input->birthday) ||
//    empty($input->address) ||
//    empty($input->front_image) ||
//    empty($input->back_image)
//) {
//    die(json_encode(array('code' => 1, 'message' => 'Invalid information')));
//}
//print_r($_POST);
//print_r($_FILES);

//if (isset($_POST['phone'])) {
//    $phone = $_POST['phone'];
//}
//$phone = getPost('phone');
//$email = getPost('email');
//$full_name = getPost('full_name');
//$birthday = getPost('birthday');
//$address = getPost('address');
$phone = $_POST['phone'];
$email = $_POST['email'];
$full_name = $_POST['full_name'];
$birthday = $_POST['birthday'];
$address = $_POST['address'];
// file
//$valid_extensions = array('jpeg', 'jpg', 'png', 'gif', 'bmp' , 'pdf' , 'doc' , 'ppt'); // valid extensions
$path = '../images/'; // upload directory
//$front_image = getPost('front_image');
//$back_image = getPost('back_image');
//$front_image = $_POST['front_image'];
//$back_image = $_POST['back_image'];

$front_image = $_FILES['front_image']['name'];
$front_image_tmp = $_FILES['front_image']['tmp_name'];
$back_image = $_FILES['back_image']['name'];
$back_image_tmp = $_FILES['back_image']['tmp_name'];
//print_r($_FILES);

$ext1 = strtolower(pathinfo($front_image, PATHINFO_EXTENSION));
$ext2 = strtolower(pathinfo($back_image, PATHINFO_EXTENSION));

$filename = tempnam($path, 'front-image');
//echo $filename . '.' . $ext1;
move_uploaded_file($front_image_tmp, $filename . '.' . $ext1);
unlink($filename);
$front_image = basename($filename . '.' . $ext1);

$filename = tempnam($path, 'back-image');
move_uploaded_file($back_image_tmp, $filename . '.' . $ext2);
unlink($filename);
$back_image = basename($filename . '.' . $ext2);
//move_uploaded_file($front_image_tmp, $front_image);
//move_uploaded_file($back_image_tmp, $back_image);

if (isValue('users', 'phone', $phone)
) {
    die(json_encode(array('response' => 'Sorry! your phone is exits!')));
}

if (isValue('users', 'email', $email)) {
    die(json_encode(array('response' => 'Sorry! your email is exits!')));
}

$username = getNewUsername();
$password = getNewPassword();
while (isValue('users', 'username', $username)
    && isValue('users', 'password', $password)) {
    $user_name = getNewUsername();
    $password = getNewPassword();
}

$query = "INSERT INTO `users` 
    (`phone`, `email`, `full_name`,
     `birthday`, `address`, `front_image`,
     `back_image`, `username`, `password`, `create_at`, `update_at`) 
    VALUES('$phone', '$email', '$full_name',
           '$birthday', '$address', '$front_image', 
           '$back_image', '$username', '" . md5(
        $phone . $full_name .
        $password
    ) . "','" . date('Y-m-d') . "', '" . date('Y-m-d') . "'
    )";

$response = execute($query);

if ($response['response'] == 'success') {
    //    sent mail
    $_SESSION['phone'] = $phone;
    $_SESSION['password'] = $password;
    die(
    json_encode(array(
        'response' => 'Sign up Success',
        'data' => array(
            'username' => $username, 'password' =>
                $password
        )
    , 'code' => 200
    ))
    );
} else {
    die(json_encode(array('response' => 'Sign up Fail', 'code' => 400)));
}
