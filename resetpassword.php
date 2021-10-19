<?php
require "connection.php";

$email = $_POST["em"];
$np = $_POST["np"];
$rnp = $_POST["rnp"];
$vc = $_POST["vc"];


if (empty($email)) {
    echo "Missing Email Address!";
} else if (empty($np)) {
    echo "Enter New Password!";
} else if (strlen($np) < 3 || strlen($np) > 20) {
    echo "Password should be less than 20 characters and more than 3";
} else if (empty($rnp)) {
    echo "Enter Re-enter New Password!";
} else if ($np != $rnp) {
    echo "Enter Same Password!";
} else if (empty($vc)) {
    echo "Enter Verification Code!";
} else {

    $rs = database::search("SELECT * FROM user WHERE `email`='$email' AND `verification_code`='$vc'");

    if ($rs->num_rows == 1) {
        database::iud("UPDATE user SET `password`='$np' WHERE `email`='$email' ");
        echo "success";
    } else {
        echo "Password Reset Failed";
    }
}
