<?php
session_start();
require "connection.php";

$id = $_GET["id"];
$qty = $_GET["qty"];
$email = $_SESSION["u"]["email"];

if ($qty == 0) {
    echo "Please enter Quantity";
} else {
    $productrs = database::search("SELECT `qty` FROM `product` WHERE `id`='$id'");
    $pr = $productrs->fetch_assoc();

    if ($pr["qty"] < $qty) {
        echo "Please select a lower quantity";
    } else {

        $cartrs = database::search("SELECT * FROM cart WHERE `user_email`='$email' AND `product_id`='$id'");
        $cn = $cartrs->num_rows;
        if ($cn == 1) {
            echo "This product is already added to your Cart";
        } else {

            database::iud("INSERT INTO `cart`(`user_email`,`product_id`,`qty`) VALUES('$email','$id','$qty')");
            echo "success";
        }
    }
}