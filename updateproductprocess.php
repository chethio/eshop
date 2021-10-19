<?php
require "connection.php";
error_reporting(0);

$id = $_POST["id"];
$category = $_POST["c"];
$title = $_POST["t"];
$qty = (int)$_POST["qty"];
$cost = $_POST["cost"];
$dwc = $_POST["dwc"];
$doc = $_POST["doc"];
$desc = $_POST["desc"];
$image = $_FILES["img"];


if (isset($id)) {
    if ($category == "Select Category") {
        echo "Please select a Category";
    } else {
        if (isset($image)) {
            $file_extension = $image["type"];


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

            $filename = "resources//products//" . uniqid() . $newimgextension;
            move_uploaded_file($image["tmp_name"], $filename);

            database::iud("UPDATE `image` SET `code`='$filename' WHERE `product_id`='$id'");
        }
        database::iud("UPDATE product SET `category_id`='$category',`title`='$title',`qty`='$qty',`price`='$cost',`delivery_fee_colombo`='$dwc',`delivery_fee_other`='$doc',`description`='$desc' WHERE `id`='$id'");

        echo "Product Updated";
    }
} else {
    echo "Please enter product ID";
}