<?php
require "connection.php";
error_reporting(0);
$category = $_POST['c'];
$brand = $_POST['b'];
$model = $_POST['m'];
$title = $_POST['t'];
$condition = $_POST['co'];
$color = $_POST['col'];
$qty = (int)$_POST['qty'];
$price = (int)$_POST['p'];
$dwc = (int)$_POST['dwc'];
$doc = (int)$_POST['doc'];
$description = $_POST['desc'];
$image1 = $_FILES["img1"];
$image2 = $_FILES["img2"];
$image3 = $_FILES["img3"];

$d = new DateTime();
$tz = new DateTimeZone("Asia/Colombo");
$d->setTimezone($tz);
$date = $d->format("Y-m-d H:i:s");

$state = 1;
$useremail = "chethanabishek@gmail.com";
// echo $category;
// echo $model;
// echo $brand;
// echo $title;
// echo $condition;
// echo $color;
// echo $qty;
// echo $price;
// echo $dwc;
// echo $doc;
// echo $description;
// echo $image;

if ($category == "Select Category") {
    echo "Please select a Category";
} else if ($brand == "Select Brand") {
    echo "Please select a Brand";
} else if ($model == "Select Model") {
    echo "Please select a Model";
} else if (empty($title)) {
    echo "Please Add a Title";
} else if (strlen($title) >= 100) {
    echo "Title should have 100 or less characters";
} else if (empty($qty)) {
    echo "Please Add a Quantity";
} else if ($qty == "0" || $qty == "e") {
    echo "Please Add a Quantity of your Product";
} else if (!is_int($qty)) {
    echo "Please enter a Valid Quantity";
} else if ($qty < 0) {
    echo "Please enter a Valid Quantity";
} else if (empty($price)) {
    echo "Please enter a Price";
} else if (!is_int($price)) {
    echo "Please enter a Valid Price";
} else if (empty($dwc)) {
    echo "Please enter a Price for the Delivery Cost within Colombo";
} else if (!is_int($dwc)) {
    echo "Please enter a Valid Price for the Delivery Cost within Colombo";
} else if (empty($doc)) {
    echo "Please enter a Price for the Delivery Cost";
} else if (!is_int($doc)) {
    echo "Please enter a Valid Price for the Delivery Cost";
} else if (empty($description)) {
    echo "Please enter a Description of your Product";
} else {
    $modelhasbrand = database::search("SELECT `id` FROM `model_has_brand` WHERE `brand_id`='$brand' AND `model_id`='$model'");
    if ($modelhasbrand->num_rows == 0) {
        echo "Such Product Doest Exist";
    } else {
        $f = $modelhasbrand->fetch_assoc();
        $modelhasbrand_id = $f["id"];

        database::iud("INSERT INTO `product`(`category_id`,`model_has_brand_id`,`title`,`color_id`,`price`,`qty`,`description`,`condition_id`,`status_id`,`user_email`,`datetime_added`,`delivery_fee_colombo`,`delivery_fee_other`) 
        VALUES('$category','$modelhasbrand_id','$title','$color','$price','$qty','$description','$condition','$state','$useremail','$date','$dwc','$doc')");
        // echo "Product Successfully Registered";

        $last_id = database::$connection->insert_id;


        // $file_extension = pathinfo($image, PATHINFO_EXTENSION);

        // if (!file_exists($image)) {
        //     echo "Please add Images";
        // } else if (!in_array($file_extension, $allowed_image_extension)) {
        //     echo "Please select a valid Image";
        // } else {
        // }

        function fileupload($img, $last_id)
        {
            if (isset($img)) {
                $allowed_image_extension = array("image/jpeg", "image/jpg", "image/png", "image/svg");
                $file_extension = $img["type"];
                if (!in_array($file_extension, $allowed_image_extension)) {
                    echo "Please select a valid Image";
                } else {
                    // echo $image["name"];

                    $newimgextension = "";
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
                    move_uploaded_file($img["tmp_name"], $filename);

                    database::iud("INSERT INTO `image`(`code`,`product_id`) VALUES('$filename','$last_id')");
                    echo "success";
                }
            } else {
                echo "Please select an Image";
            }
        }

        fileupload($image1, $last_id);
        fileupload($image2, $last_id);
        fileupload($image3, $last_id);

        // if (isset($_FILES["img"])) {
        //     $allowed_image_extension = array("image/jpeg", "image/jpg", "image/png", "image/svg");
        //     $file_extension = $image["type"];
        //     if (!in_array($file_extension, $allowed_image_extension)) {
        //         echo "Please select a valid Image";
        //     } else {
        //         // echo $image["name"];

        //         $newimgextension;
        //         if ($file_extension = "image/jpeg") {
        //             $newimgextension = ".jpeg";
        //         } else if ($file_extension = "image/jpg") {
        //             $newimgextension = ".jpg";
        //         } else if ($file_extension = "image/png") {
        //             $newimgextension = ".png";
        //         } else if ($file_extension = "image/svg") {
        //             $newimgextension = ".svg";
        //         }

        //         $filename = "resources//products//" . uniqid() . $newimgextension;
        //         move_uploaded_file($image["tmp_name"], $filename);

        //         database::iud("INSERT INTO `image`(`code`,`product_id`) VALUES('$filename','$last_id')");
        //         echo "Product Successfully Registered";
        //     }
        // } else {
        //     echo "Please select an Image";
        // }
    }
}
