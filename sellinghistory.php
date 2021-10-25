<?php
require "connection.php";

$from = $_GET["f"];
$to = $_GET["t"];

?>

<!DOCTYPE html>

<html>

<head>

    <title>eShop | Manage Product Selling History</title>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="icon" href="resources/logo.svg">

    <link rel="stylesheet" href="bootstrap.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.6.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="style.css">

</head>

<body style="background-color: #74EBD5; background-image: linear-gradient(90deg,#74EBD5 0%,#9FACE6 100%); min-height: 100vh;">

    <div class="container-fluid">
        <div class="row">

            <div class="col-12 bg-light text-center rounded">
                <label class="form-label fs-2 fw-bold text-primary">Products Selling History</label>
            </div>

            <div class="col-12 mt-2">
                <div class="row">
                    <div class="col-lg-2 col-2 bg-primary text-white fw-bolder p-2">
                        <span>Order ID</span>
                    </div>
                    <div class="col-lg-3 col-10  bg-light fw-bolder p-2">
                        <span>Product</span>
                    </div>
                    <div class="col-lg-3 bg-primary text-white fw-bolder p-2 d-none d-lg-block">
                        <span>Buyyer</span>
                    </div>
                    <div class="col-lg-2 bg-light fw-bolder p-2 d-none d-lg-block">
                        <span>Price</span>
                    </div>
                    <div class="col-lg-2 bg-primary text-white fw-bolder p-2 d-none d-lg-block">
                        <span>Qunatity</span>
                    </div>
                </div>
            </div>

            <div class="col-12 mt-2 mb-3">


                <?php

                if (!empty($from) && empty($to)) {
                    $fromrs = database::search("SELECT * FROM `invoice` ");
                    $fn = $fromrs->num_rows;

                    for ($x = 0; $x < $fn; $x++) {
                        $fr = $fromrs->fetch_assoc();
                        $fromdate = $fr["date"];

                        $splitdate = explode(" ", $fromdate);
                        $date = $splitdate[0];

                        if ($from == $date) {
                ?>



                            <div class="row py-1">

                                <div class="col-lg-2 col-2 bg-primary text-white fw-bold p-2">
                                    <span>000001</span>
                                </div>
                                <div class="col-lg-3 col-10 bg-light fw-bold p-2">
                                    <span>Apple iPhone 12</span>
                                </div>
                                <div class="col-lg-3 bg-primary text-white fw-bold p-2 d-none d-lg-block">
                                    <span>Sandaruwan Senanayaka</span>
                                </div>
                                <div class="col-lg-2 bg-light fw-bold p-2 d-none d-lg-block">
                                    <span>Rs.100000.00</span>
                                </div>
                                <div class="col-lg-2 bg-primary text-white fw-bold p-2 d-none d-lg-block">
                                    <span>01</span>
                                </div>
                            </div>




                        <?php
                        }
                    }
                } else if (!empty($from) && !empty($to)) {
                    $betweenrs = database::search("SELECT * FROM `invoice` ");
                    $bn = $betweenrs->num_rows;

                    for ($x = 0; $x < $bn; $x++) {
                        $br = $betweenrs->fetch_assoc();
                        $betweendate = $br["date"];


                        $splitdate = explode(" ", $betweendate);
                        $date = $splitdate[0];

                        if ($from <= $date && $to >= $date) {
                        ?>

                            <div class="row py-1">

                                <div class="col-lg-2 col-2 bg-primary text-white fw-bold p-2">
                                    <span>000001</span>
                                </div>
                                <div class="col-lg-3 col-10 bg-light fw-bold p-2">
                                    <span>Apple iPhone 12</span>
                                </div>
                                <div class="col-lg-3 bg-primary text-white fw-bold p-2 d-none d-lg-block">
                                    <span>Sandaruwan Senanayaka</span>
                                </div>
                                <div class="col-lg-2 bg-light fw-bold p-2 d-none d-lg-block">
                                    <span>Rs.100000.00</span>
                                </div>
                                <div class="col-lg-2 bg-primary text-white fw-bold p-2 d-none d-lg-block">
                                    <span>01</span>
                                </div>
                            </div>


                        <?php
                        }
                    }
                } else {
                    $todayrs = database::search("SELECT * FROM `invoice` ");
                    $tn = $todayrs->num_rows;

                    for ($x = 0; $x < $tn; $x++) {
                        $tr = $todayrs->fetch_assoc();
                        $nodate = $tr["date"];


                        $splitdate = explode(" ", $nodate);
                        $date = $splitdate[0];

                        $today = date("Y-m-d");
                        if ($today == $date) {

                        ?>

                            <div class="row py-1">

                                <div class="col-lg-2 col-2 bg-primary text-white fw-bold p-2">
                                    <span>000001</span>
                                </div>
                                <div class="col-lg-3 col-10 bg-light fw-bold p-2">
                                    <span>Apple iPhone 12</span>
                                </div>
                                <div class="col-lg-3 bg-primary text-white fw-bold p-2 d-none d-lg-block">
                                    <span>Sandaruwan Senanayaka</span>
                                </div>
                                <div class="col-lg-2 bg-light fw-bold p-2 d-none d-lg-block">
                                    <span>Rs.100000.00</span>
                                </div>
                                <div class="col-lg-2 bg-primary text-white fw-bold p-2 d-none d-lg-block">
                                    <span>01</span>
                                </div>
                            </div>


                <?php
                        } else {
                            echo "No SELLINGS DONE TODAY";
                        }
                    }
                }

                ?>

            </div>

            <div class="col-12 mt-3 mb-3">
                <div class="row">
                    <div class="text-center fw-bold">
                        <div class="pagination">
                            <a href="#">&laquo;</a>
                            <a href="#">1</a>
                            <a class="active" href="#">2</a>
                            <a href="#">3</a>
                            <a href="#">4</a>
                            <a href="#">5</a>
                            <a href="#">6</a>
                            <a href="#">&raquo;</a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- footer -->
            <?php require "footer.php"; ?>
            <!-- footer -->

        </div>
    </div>

</body>

</html>