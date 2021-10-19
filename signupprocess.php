<?php
require "connection.php";

$fname = $_POST["fname"];
$lname = $_POST["lname"];
$email = $_POST["email"];
$password = $_POST["password"];
$mobile = $_POST["mobile"];
$gender = $_POST["gender"];



if (empty($fname)) {
    echo "Enter First Name";
} else if (strlen($fname) >= 40) {
    echo "First Name should be less than 40 characters";
} else if (empty($lname)) {
    echo "Enter Last Name";
} else if (strlen($lname) >= 45) {
    echo "Last Name should be less than 45 characters";
} else if (empty($email)) {
    echo "Enter Email";
} else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo "Enter Valid Email";
} else if (strlen($email) >= 45) {
    echo "Email should be less than 45 characters";
} else if (empty($password)) {
    echo "Enter Password";
} else if (strlen($password) < 3 || strlen($password) > 20) {
    echo "Password should be less than 20 characters and more than 3";
} else if (empty($mobile)) {
    echo "Enter Mobile";
} else if (strlen($mobile) != 10) {
    echo "Mobile should have 10 characters";
} else if (preg_match("/07[0,1,2,4,5,6,7,8][0-9]+/", $mobile) == 0) {
    echo "Enter Srilankan No.";
} else {

    $r = database::search("SELECT * FROM user WHERE `email`='$email' OR `mobile`='$mobile'");
    if ($r->num_rows > 0) {
        echo "User Already Exist";
    } else {
        $d = new DateTime();
        $tz = new DateTimeZone("Asia/Colombo");
        $d->setTimezone($tz);
        $date = $d->format("Y-m-d H:i:s");

        database::iud("INSERT INTO user(`email`,`fname`,`lname`,`password`,`mobile`,`register_date`,`gender_id`) VALUES('$email','$fname','$lname','$password','$mobile','$date','$gender')");
        echo "Success";
    }
}
