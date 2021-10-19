<?php
session_start();

require "connection.php";

$email = $_POST["email"];
$pass = $_POST["password"];
$remember = $_POST["remember"];

if (empty($email)) {
    echo "Enter Email";
} else if (empty($pass)) {
    echo "Enter Password";
} else {

    $r = database::search("SELECT * FROM user WHERE `email`='$email' AND `password`='$pass'");
    $n = $r->num_rows;

    if ($n == 1) {
        echo "Success";

        $d = $r->fetch_assoc();
        $_SESSION["u"] = $d["fname"];
        $_SESSION["u"] = $d;

        if ($remember == "true") {

            setcookie("e", $email, time() + (60 * 60 * 24 * 365));
            setcookie("p", $pass, time() + (60 * 60 * 24 * 365));
        } else {
            setcookie("e", "", -1);
            setcookie("p", "", -1);
        }
    } else {
        echo "Invalid Details";
    }
}