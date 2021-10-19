<?php

require "connection.php";


if (isset($_GET["id"])) {
    $array = [];
    $id = $_GET["id"];

    if (empty($id)) {
        echo "Please enter the product id to be updated";
    } else {
        $prs = database::search("SELECT * FROM product WHERE `id`='$id'");
        $n = $prs->num_rows;
        if ($n == 1) {
            $pr = $prs->fetch_assoc();
            $array["id"] = $pr["id"];

            $crs = database::search("SELECT * FROM category WHERE `id`='" . $pr["category_id"] . "'");
            if ($crs->num_rows == 1) {
                $cr = $crs->fetch_assoc();
                $array["category"] = $cr["name"];
            }


            $imgrs = database::search("SELECT * FROM `image` WHERE `product_id`='" . $pr["id"] . "'");
            if ($imgrs->num_rows == 1) {
                $imgr = $imgrs->fetch_assoc();
                $array["img"] = $imgr["code"];
            }
            $array["ti"] = $pr["title"];
            $array["qty"] = $pr["qty"];
            $array["price"] = $pr["price"];
            $array["dwc"] = $pr["delivery_fee_colombo"];
            $array["doc"] = $pr["delivery_fee_other"];
            $array["desc"] = $pr["description"];


            echo  json_encode($array);
        } else {
            echo "Incoreect ID";
        }
    }
}