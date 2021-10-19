<?php
session_start();
require "connection.php";
$u = $_SESSION["u"]["email"];
$id = $_GET["id"];

$product = database::search("SELECT * FROM `product` WHERE `user_email`='$u' AND `id`='$id'");
$n = $product->num_rows;

if ($n == 1) {
    $row = $product->fetch_assoc();

    $img = database::search("SELECT * FROM `image` WHERE `product_id`='" . $row["id"] . "' ");
    $imgd = $img->fetch_assoc();


    $_SESSION["p"] = $row;

    echo "success";
} else {
    echo "error";
}