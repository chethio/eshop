<?php
error_reporting(0);
session_start();
require "connection.php";
if (isset($_SESSION["u"])) {

    $u = $_SESSION["u"];


    $fname = $_POST["fn"];
    $lname = $_POST["ln"];
    $mobile = $_POST["mb"];
    $line1 = $_POST["l1"];
    $line2 = $_POST["l2"];
    $city = $_POST["c"];
    $pc = $_POST["pc"];
    $district = $_POST["d"];
    $province = $_POST["p"];
    $img = $_FILES["img"];


    if (isset($_FILES["img"])) {
        $file_extension = $img["type"];


        $newimgextension;
        if ($file_extension = "image/jpeg") {
            $newimgextension = ".jpeg";
        } else if ($file_extension = "image/jpg") {
            $newimgextension = ".jpg";
        } else if ($file_extension = "image/png") {
            $newimgextension = ".png";
        } else if ($file_extension = "image/svg") {
            $newimgextension = ".svg";
        }

        $filename = "resources//profile//" . uniqid() . $newimgextension;
        move_uploaded_file($img["tmp_name"], $filename);

        $profile = database::search("SELECT * FROM `profile_img` WHERE user_email='" . $u["email"] . "'");
        $npr = $profile->num_rows;

        if ($npr == 1) {
            database::iud("UPDATE profile_img SET `code`='$filename' WHERE `user_email`='" . $u["email"] . "'");
            echo "User profile pic updated";
            echo "<br>";
        } else {
            database::iud("INSERT INTO `profile_img`(`code`,`user_email`) VALUES('$filename','" . $u["email"] . "')");
            echo "Profile pic added";
        }
    }

    if (empty($fname)) {
        echo "Enter First Name";
    } else if (strlen($fname) >= 40) {
        echo "First Name should be less than 40 characters";
    } else if (empty($lname)) {
        echo "Enter Last Name";
    } else if (strlen($lname) >= 45) {
        echo "Last Name should be less than 45 characters";
    } else if (empty($mobile)) {
        echo "Enter Mobile";
    } else if (strlen($mobile) != 10) {
        echo "Mobile should have 10 characters";
    } else if (preg_match("/07[0,1,2,4,5,6,7,8][0-9]+/", $mobile) == 0) {
        echo "Enter Srilankan No.";
    } else if (empty($line1)) {
        echo "Enter Address Line 1";
    } else if (empty($line2)) {
        echo "Enter Address Line 2";
    } else if ($city == "Select Your City") {
        echo "Enter City Name";
    } else if ($district == "Select Your District") {
        echo "Enter District Name";
    } else if ($province == "Select Your Province") {
        echo "Enter City Province";
    } else if (empty($pc)) {
        echo "Enter Postal Code";
    } else {



        database::iud("UPDATE user SET `fname`='$fname', `lname`='$lname',`mobile`='$mobile' WHERE `email`='" . $u["email"] . "'");


        $address = database::search("SELECT * FROM `user_has_address` WHERE user_email='" . $u["email"] . "'");
        $nr = $address->num_rows;

        if ($nr == 1) {
            // update
            database::iud("UPDATE user_has_address SET `line1`='$line1', `line2`='$line2',`city_id`='$city' WHERE `user_email`='" . $u["email"] . "'");
            $user = database::search("SELECT * FROM `user`");
            $userd = $user->fetch_assoc();
            $_SESSION["u"] = $userd;
            echo "User details updated";
        } else {
            // add new
            // $ucity = database::search("SELECT `id` FROM city WHERE `name`='$city'");
            $u = $_SESSION["u"]["email"];
            database::iud("INSERT INTO user_has_address(`user_email`,`line1`,`line2`,`city_id`) VALUES('$u','$line1','$line2','$city')");
            echo "User address added";
        }
    }
}
