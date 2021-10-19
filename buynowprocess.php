<?php
session_start();
require "connection.php";

if (isset($_SESSION["u"])) {
    $u = $_SESSION["u"];


    $id = $_GET["id"];
    $qty = $_GET["qty"];
    $email = $_SESSION["u"]["email"];

    $array;

    $order_id = uniqid();

    //product data
    $productrs = database::search("SELECT * FROM `product` WHERE `id`='$id'");
    $pr = $productrs->fetch_assoc();

    $item = $pr["title"];

    //product data




    //address data
    $addressrs = database::search("SELECT * FROM `user_has_address` WHERE `user_email`='$email'");
    $an = $addressrs->num_rows;


    if ($an == 1) {
        $ar = $addressrs->fetch_assoc();

        $address = $ar["line1"] . "," . $ar["line2"];

        $cid = $ar["city_id"];


        $cityrs = database::search("SELECT * FROM `city` WHERE `id`='$cid'");
        $cr = $cityrs->fetch_assoc();
        $city = $cr["name"];

        $district_id = $cr["district_id"];
        $delivery = "0";

        if ($district_id == "4") {
            $delivery = $pr["delivery_fee_colombo"];
        } else {
            $delivery = $pr["delivery_fee_other"];
        }

        //address data

        $amount = $pr["price"] * $qty + (int)$delivery;



        //user data
        $fname = $u["fname"];
        $lname = $u["lname"];
        $mobile = $u["mobile"];
        //user data

        $array['id'] = $order_id;
        $array['item'] = $item;
        $array['amount'] = $amount;
        $array['fname'] = $fname;
        $array['lname'] = $lname;
        $array['email'] = $email;
        $array['mobile'] = $mobile;
        $array['address'] = $address;
        $array['city'] = $city;

        echo json_encode($array);
    } else {
        echo "2";
    }
} else {
    echo "1";
}