<?php
require "connection.php";

if (isset($_POST["id"])) {

    $id = $_POST["id"];

    $productrs = database::search("SELECT * FROM `product` WHERE `id`='$id'");
    $num = $productrs->num_rows;

    if ($num == 1) {

        $row = $productrs->fetch_assoc();
        $us = $row["status_id"];

        if ($us == 1) {

            database::iud("UPDATE `product` SET `status_id`='2' WHERE `id` ='$id'");

            echo "1";
        } else {
            database::iud("UPDATE `product` SET `status_id`='1' WHERE `id` ='$id'");
            echo "2";
        }
    }
}