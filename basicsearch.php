<?php
require "connection.php";

$search = $_GET["s"];
$category = $_GET["c"];
$array;


if (!empty($search) && $category == 0) {
    $textsearch = database::search("SELECT * FROM product WHERE `title` LIKE '%" . $search . "%'");
    $n = $textsearch->num_rows;
    if ($n >= 1) {
        for ($i = 0; $i < $n; $i++) {
            $row = $textsearch->fetch_assoc();

            $img = database::search("SELECT * FROM `image` WHERE `product_id`='" . $row["id"] . "'");
            $imgn = $img->num_rows;
            if ($imgn >= 1) {
                $row1 = $img->fetch_assoc();
                $row["img"] = $row1["code"];
            }
            $array[$i] = $row;
        }
        echo json_encode($array);
    } else {
        echo "0";
    }
} else if ($category != 0 && empty($search)) {
    $categorysearch = database::search("SELECT * FROM product WHERE `category_id`='$category'");
    $cn = $categorysearch->num_rows;
    if ($cn >= 1) {
        for ($i = 0; $i < $cn; $i++) {
            $crow = $categorysearch->fetch_assoc();

            $img = database::search("SELECT * FROM `image` WHERE `product_id`='" . $crow["id"] . "'");
            $imgn = $img->num_rows;
            if ($imgn >= 1) {
                $row2 = $img->fetch_assoc();
                $crow["img"] = $row2["code"];
            }
            $array[$i] = $crow;
        }
        echo json_encode($array);
    } else {
        echo "0";
    }
} else if (!empty($search) && $category != 0) {
    $bothsearch = database::search("SELECT * FROM product WHERE `category_id`='$category' AND `title` LIKE '%" . $search . "%'");
    $bn = $bothsearch->num_rows;
    if ($bn >= 1) {
        for ($i = 0; $i < $bn; $i++) {
            $brow = $bothsearch->fetch_assoc();

            $img = database::search("SELECT * FROM `image` WHERE `product_id`='" . $brow["id"] . "'");
            $imgn = $img->num_rows;
            if ($imgn >= 1) {
                $row3 = $img->fetch_assoc();
                $brow["img"] = $row3["code"];
            }
            $array[$i] = $brow;
        }
        echo json_encode($array);
    } else {
        echo "0";
    }
} else {
}