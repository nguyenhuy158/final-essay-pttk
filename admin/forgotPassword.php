<?php
session_start();
header('Content-Type: application/json; charset=utf-8');

require_once('./configDB.php');
require_once('./myMailer.php');

$phone = $_POST['phone'];
$email = $_POST['email'];

//print_r($_POST);

if (!isValue('users', 'phone', $phone) || !isValue('users', 'email', $email)
) {
    die(json_encode(array('response' => 'Sorry! your phone or email is not exits!', 'code' => 400)));
}


$query = "SELECT * FROM users WHERE phone = '$phone' and email = '$email'";

$userInfo = executeResult($query, true);
//print_r($userInfo);
//print_r($_SESSION);

if (!is_null($userInfo)) {
    $_SESSION['username_forgot'] = $userInfo['username'];
    //    sent mail
    $otp = rand(100000, 999999);
    $name = $userInfo['full_name'];
    $username = $userInfo['username'];
    $full_name = $userInfo['full_name'];
    $subject = "Your verify code";
    $body = "
        <div style='font-family: Helvetica, Arial, sans-serif; min-width: 1000px; overflow: auto; line-height: 2;'>
            <div style='margin: 50px auto; width: 70%; padding: 20px 0;'>
                <div style='border-bottom: 1px solid #eee;'>
                    <a href='' style='font-size: 1.4em; color: #00466a; text-decoration: none; font-weight: 600;'>Developer Team</a>
                </div>
                <p style='font-size: 1.1em;'>Dear $name,</p>
                <p>Do you want to get a new password, please use this OTP code to continue. <strong>Please do not share your information with anybody else.</strong></p>
                <h2 style='background: #00466a; margin: 0 auto; width: max-content; padding: 0 10px; color: #fff; border-radius: 4px;'>
                    OTP: $otp
                </h2>
                <h2 style='background: #00466a; margin: 0 auto; width: max-content; padding: 0 10px; color: #fff; border-radius: 4px;'></h2>
                <p style='font-size: 0.9em;'>
                    Regards,<br />
                    Nguyen Huy
                </p>
            </div>
        </div>
    ";
    $response = sentMail($subject, $body, $email);
    if ($response) {
        $query = "UPDATE users 
                    SET otp = '" . md5($phone . $full_name . $otp) . "',
                        otp_time = '" . date("Y-m-d h:i:s") . "' 
                    WHERE username = '$username'";
        $response = execute($query);
    }
    die(json_encode(array('response' => $response ? 'OTP sent success' : 'OTP sent fail', 'code' => 200)));
} else {
    die(json_encode(array('response' => 'Sorry! your phone or email is not exits!', 'code' => 400)));
}

