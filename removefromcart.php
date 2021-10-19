<?php
session_start();
if (isset($_SESSION["u"])) {

    require "connection.php";

    $id = $_GET["id"];
    $email = $_SESSION["u"]["email"];

    $cartrs = database::search("SELECT `product_id` FROM `cart` WHERE `id`='$id'");
    $cr = $cartrs->fetch_assoc();
    $pid = $cr["product_id"];

    $recentrs = database::search("SELECT * FROM `recent` WHERE `user_email`='$email' AND `product_id`='$pid'");
    $rn = $recentrs->num_rows;

    if ($rn == 1) {
        database::iud("DELETE FROM `cart` WHERE `id`='$id' ");
        echo "succcess";
    } else {
        database::iud("INSERT INTO `recent`(`product_id`,`user_email`) VALUES('$pid','$email')");
        database::iud("DELETE FROM `cart` WHERE `id`='$id' ");
        echo "succcess";
    }
}