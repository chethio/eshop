<?php
require "connection.php";

session_start();
if (isset($_SESSION["u"])) {
    $email = $_SESSION["u"]["email"];

    $id = $_POST["i"];
    $feedback = $_POST["t"];
    $d = new DateTime();
    $tz = new DateTimeZone("Asia/Colombo");
    $d->setTimezone($tz);
    $date = $d->format("Y-m-d H:i:s");

    if (!empty($feedback)) {

        database::iud("INSERT INTO `feedback`(`user_email`,`product_id`,`feed`,`date`) VALUES('$email','$id','$feedback','$date')");
        echo "1";
    } else {
        echo "2";
    }
}