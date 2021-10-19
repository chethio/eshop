<?php
session_start();
require "connection.php";

if (isset($_SESSION["u"])) {

    $oid = $_POST["oid"];
    $pid = $_POST["pid"];
    $email = $_POST["email"];
    $total = $_POST["total"];
    $pqty = $_POST["pqty"];

    $productrs = database::search("SELECT * FROM `product` WHERE `id`='$pid'");
    $pr = $productrs->fetch_assoc();

    $qty = $pr["qty"];

    $newqty = $qty - $pqty;


    // updating quantity in product table
    database::iud("UPDATE `product` SET `qty`='$newqty' WHERE `id`='$pid'");

    // insert into invoice

    $d = new DateTime();
    $tz = new DateTimeZone("Asia/Colombo");
    $d->setTimezone($tz);
    $date = $d->format("Y-m-d H:i:s");
    database::iud("INSERT INTO `invoice`(`order_id`,`product_id`,`user_email`,`total`,`date`,`qty`) VALUES('$oid','$pid','$email','$total','$date','$pqty')");
    echo "1";
}
