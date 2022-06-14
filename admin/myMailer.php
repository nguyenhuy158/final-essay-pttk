<?php
require_once "Mail/phpmailer/PHPMailerAutoload.php";
function sentMail($subject, $body, $email)
{
    $mail = new PHPMailer;

    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->Port = 587;
    $mail->SMTPAuth = true;
    $mail->SMTPSecure = 'tls';

    $mail->Username = '';
    $mail->Password = '';

    $mail->setFrom('', 'OTP Verification');
    $mail->addAddress($email);

    $mail->isHTML(true);
    $mail->Subject = $subject;
    $mail->Body = $body;
    return $mail->send();
}