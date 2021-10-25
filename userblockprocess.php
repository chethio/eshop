<?php
require "connection.php";

if (isset($_POST["e"])) {

    $email = $_POST["e"];

    $userrs = database::search("SELECT * FROM `user` WHERE `email`='$email'");
    $num = $userrs->num_rows;

    if ($num == 1) {

        $row = $userrs->fetch_assoc();
        $us = $row["status"];

        if ($us == 1) {

            database::iud("UPDATE `user` SET `status`='2' WHERE `email` ='$email'");

            echo "1";
        } else {
            database::iud("UPDATE `user` SET `status`='1' WHERE `email` ='$email'");
            echo "2";
        }
    }
}