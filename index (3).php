<?php

use PHPMailer\PHPMailer\PHPMailer;

require 'Exception.php';
require 'PHPMailer.php';
require 'SMTP.php';

$mail = new PHPMailer;
$mail->IsSMTP();
$mail->Host = 'smtp.gmail.com';
$mail->SMTPAuth = true;
$mail->Username = 'chethanabishek@gmail.com'; //myemail
$mail->Password = 'che123//';
$mail->SMTPSecure = 'ssl';
$mail->Port = 465;
$mail->setFrom('chethanabishek6@gmail.com', 'eshop');  //seccondary my email
$mail->addReplyTo('chethanabishek@gmail.com', 'eshop'); //to which email the reply should be recieved

$mail->addAddress('uvindamanduriperera@gmail.com'); //recievers email
$mail->addAddress('myrecbuddhi@gmail.com');

$mail->isHTML(true);
$mail->Subject = 'E-shop Forgot Password Verification';
$bodyContent = '<h1>wussup</h1>';
$bodyContent .= '<h1 style="color:red;"> Verification code:</h1>';
$mail->Body    = $bodyContent;

if (!$mail->send()) {
    echo 'Verification could not be sent. Mailer Error: ' . $mail->ErrorInfo;
} else {
    echo 'Verification has been sent.';
}
