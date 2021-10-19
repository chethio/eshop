<?php
require "connection.php";
$id = $_GET["id"];

$watchrs = database::search("SELECT * FROM `watchlist` WHERE `id`='$id'");
$watchrow = $watchrs->fetch_assoc();

$pid = $watchrow["product_id"];

$email = $watchrow["user_email"];

database::iud("INSERT INTO `recent`(`product_id`,`user_email`) VALUES('$pid','$email')");

database::iud("DELETE FROM `watchlist` WHERE `id`='$id'");
echo "success";
