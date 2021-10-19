<?php

use PHPMailer\PHPMailer\PHPMailer;

require "connection.php";

require 'Exception.php';
require 'PHPMailer.php';
require 'SMTP.php';

if (isset($_GET["e"])) {
    $email = $_GET["e"];
    if (empty($email)) {
        echo "Please Enter Your Email!";
    } else {
        $rs = database::search("SELECT * FROM user WHERE `email`='$email' ");

        if ($rs->num_rows == 1) {
            $code = uniqid();
            database::iud("UPDATE user SET `verification_code`='$code' WHERE `email`='$email'");


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

            $mail->addAddress($email); //recievers email

            // $mail->addAddress('myrecbuddhi@gmail.com');

            $mail->isHTML(true);
            $mail->Subject = 'E-shop Forgot Password Verification';
            $bodyContent = '<h1>wussup</h1>';
            $bodyContent .= '<h1 style="color:red;"> Verification code:' . $code . '</h1>';
            $mail->Body    = $bodyContent;
            if (!$mail->send()) {
                echo 'Verification could not be sent. Mailer Error: ' . $mail->ErrorInfo;
            } else {
                echo 'success';
            }
        } else {
            echo "Email Address Not Found";
        }
    }
} else {
    echo "Please Enter Your Email First!";
}