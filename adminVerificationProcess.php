<?php

session_start();

require "connection.php";
require 'Exception.php';
require 'PHPMailer.php';
require 'SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;

if (isset($_POST["e"])) {

    $email = $_POST["e"];

    if (empty($email)) {
        echo "Please enter your email address.";
    } else {


        $adminrs = Database::search("SELECT * FROM `admin` WHERE `email`='" . $email . "'");
        $an = $adminrs->num_rows;

        if ($an == 1) {

            $code = uniqid();

            Database::iud("UPDATE `admin` SET `verification`='" . $code . "' WHERE `email`='" . $email . "'");

            $mail = new PHPMailer;
            $mail->IsSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'chethanabishek@gmail.com';
            $mail->Password = 'suck my ass';
            $mail->SMTPSecure = 'ssl';
            $mail->Port = 465;
            $mail->setFrom('chethanabishek@gmail.com', 'eShop');
            $mail->addReplyTo('chethanabishek@gmail.com', 'eShop');
            $mail->addAddress($email);
            $mail->isHTML(true);
            $mail->Subject = 'eShop Admin verification code';
            $bodyContent = '<h1 style="color:red;"> Your verification code : ' . $code . '</h1>';
            $mail->Body    = $bodyContent;

            if (!$mail->send()) {
                echo 'Verification code sending fail';
            } else {
                echo 'Success';
            }
        } else {

            echo "You are no a valid user";
        }
    }
} else {
    echo "Please enter your email";
}
