<?php
require "connection.php";

$id = $_GET["id"];

$product = database::search("SELECT * FROM product WHERE `id`='$id'");
$pn = $product->num_rows;
if ($pn == 1) {
    database::iud("DELETE FROM `image` WHERE `product_id`='$id'");


    database::iud("DELETE FROM `product` WHERE `id`='$id'");
    echo "success";
} else {
    echo "Product Does Not Exist";
}
