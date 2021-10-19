<?php
session_start();
if (isset($_SESSION["u"])) {
    $email = $_SESSION["u"]["email"];
    require "connection.php";

    $id = $_GET["id"];
    $watchlistrs = database::search("SELECT * FROM `watchlist` WHERE `product_id`='$id' AND `user_email`='$email'");
    $n = $watchlistrs->num_rows;
    if ($n == 1) {
        echo "Product Already added to the Watchlist";
    } else {
        database::iud("INSERT INTO `watchlist`(`product_id`,`user_email`) VALUES('$id','$email')");
        echo "success";
    }
}
