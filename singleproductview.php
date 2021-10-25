<?php
require "connection.php";
session_start();
if (isset($_SESSION["u"])) {


    $umail = $_SESSION["u"]["email"];

    if (isset($_GET["id"])) {
        $pid = $_GET["id"];
        // echo $pid;
        $productrs = database::search("SELECT * FROM `product` WHERE `id`='$pid' ");
        $pn = $productrs->num_rows;
        if ($pn == 1) {

            $pd = $productrs->fetch_assoc();
        }


?>

        <!DOCTYPE html>
        <html lang="en">

        <head>
            <meta charset="UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <title>Single product</title>

            <link rel="stylesheet" href="bootstrap.css">
            <link rel="stylesheet" href="style.css">
            <link rel="icon" href="resources/logo.svg">


            <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css" /> -->
            <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" />
            <script src="jquery.min.js"></script>
            <script src="bootstrap.js"></script>
            <script src="bootstrap.bundle.js"></script>
            <!-- <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/js/bootstrap.min.js"></script> -->
            <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script> -->
        </head>

        <body>

            <div class="container-fluid">

                <?php
                require "header.php";
                ?>


                <div class="row">
                    <div class="col-12 mt-0 singleproduct">
                        <div class="row">
                            <div class="bg-white" style="padding: 11px;">
                                <div class="row">
                                    <div class="col-lg-2 order-lg-1 order-2">
                                        <ul>
                                            <?php
                                            $image = database::search("SELECT * FROM `image` WHERE `product_id`='$pid'");
                                            $in = $image->num_rows;
                                            $image1;

                                            if (!empty($in)) {


                                                for ($x = 0; $x < $in; $x++) {
                                                    $d = $image->fetch_assoc();

                                                    if ($x == 0) {
                                                        $image1 = $d["code"];
                                                    }

                                            ?>

                                                    <li class="d-flex flex-column justify-content-center align-items-center border border-1 border-secondary">
                                                        <img style="background-size: contain;" class="mt-1 mb-1" height="140px" src="<?php echo $d["code"]; ?>" id="pimg<?php echo $x; ?>" onclick="loadmainimg(<?php echo $x; ?>);">
                                                    </li>

                                                <?php
                                                }
                                            } else {
                                                ?>
                                                <li class="d-flex flex-column justify-content-center align-items-center border border-1 border-secondary">
                                                    <img class="mt-1 mb-1" height="140px" src="resources/2561351_camera_icon.svg" alt="">
                                                </li>
                                                <li class="d-flex flex-column justify-content-center align-items-center border border-1 border-secondary">
                                                    <img height="140px" class="mt-1 mb-1" src="resources/2561351_camera_icon.svg" alt="">
                                                </li>
                                                <li class="d-flex flex-column justify-content-center align-items-center border border-1 border-secondary">
                                                    <img height="140px" class="mt-1 mb-1" src="resources/2561351_camera_icon.svg" alt="">
                                                </li>

                                            <?php

                                            }
                                            ?>



                                        </ul>
                                    </div>

                                    <div class="col-lg-4 order-2 order-lg-1 d-none d-lg-block">
                                        <div class=" align-items-center border border-1 border-secondary p-3">
                                            <div id="mainimg" style="background-image: url('<?php echo $image1; ?>'); background-repeat: no-repeat; background-size: contain; height: 450px;">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-6 order-3">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="row">


                                                    <div class="col-12">
                                                        <nav>
                                                            <ol class="d-flex flex-wrap mb-0 list-unstyled bg-white rounded">
                                                                <li class="breadcrumb-item"><a href="home.php">Home</a></li>

                                                                <li class="breadcrumb-item active"><a class="text-black-50  text-decoration-none" href="#">Single
                                                                        View</a></li>
                                                            </ol>
                                                        </nav>

                                                    </div>

                                                    <div class="col-4 col-lg-12">
                                                        <label class="form-label fs-4 fw-bold mt-0"><?php echo $pd["title"]; ?></label>
                                                    </div>

                                                    <div class="col-8 col-lg-12 mt-lg-1">
                                                        <span class="badge">
                                                            <i class="fa fa-star text-warning fs-6"></i>&nbsp;
                                                            <label class="text-dark fs-6">4.5 Star</label>
                                                            <label class="text-dark fs-6"> | 35 Ratings & 45 Reviews</label>
                                                        </span>
                                                    </div>

                                                    <div class="col-12">
                                                        <label class="fw-bold mt-1 fs-4 ">Rs<?php echo $pd["price"]; ?>.00</label>

                                                        <label class="fw-bold mt-1 fs-6 text-danger "><del>Rs.<?php $a = $pd["price"];
                                                                                                                $newv = ($a / 100) * 5;
                                                                                                                $val = $a + $newv;
                                                                                                                echo $val; ?></del></label>
                                                    </div>

                                                    <hr class="hr1">

                                                    <!-- <div class="col-12">
                                                <label class="text-primary fs-4 "><b>Warranty:</b> 6 Months
                                                    Warranty</label>
                                                <br>
                                                <label class="text-primary fs-4 "><b>Policy:</b> 1 Month
                                                    Return Policy</label>
                                                <br>
                                                <label class="text-primary fs-4 "><b>In Stock:</b>
                                                    <?php echo $pd["qty"]; ?> Items Left</label>
                                            </div>
                                            <hr class="hr1"> -->



                                                    <div class="col-lg-5 col-12 border border-dark mb-3">
                                                        <?php
                                                        $users = database::search("SELECT * FROM `user` WHERE `email`='" . $pd["user_email"] . "'");
                                                        $userd = $users->fetch_assoc();
                                                        ?>
                                                        <label class="text-dark fs-6 "><b>Seller:
                                                            </b><?php echo $userd["fname"] . "  " . $userd["lname"]; ?></label>
                                                        <br>
                                                        <label class="text-success fs-7 "><b>E-mail</b>
                                                            <?php echo $userd["email"]; ?></label>
                                                        <br>
                                                        <label class="text-dark fs-7 "><b>Contact: </b>
                                                            <?php echo $userd["mobile"]; ?></label>
                                                    </div>



                                                    <hr class="hr1">
                                                    <div class="col-12 col-lg-2">

                                                        <a href="messages.php?email=<?php echo $userd["email"]; ?>" class="btn btn-danger">Contact Seller</a>
                                                    </div>

                                                    <div class="col-12 mt-3 mb-3">
                                                        <div class="row">
                                                            <div class="col-lg-9 rounded border border-2 border-success mt-1">
                                                                <div class="row">
                                                                    <div class="col-md-3 col-sm-3 col-lg-1">
                                                                        <img src="resources/single product view/pricetag.png">
                                                                    </div>

                                                                    <div class="col-md-9 col-lg-11 col-sm-9 pe-4 mt-1">
                                                                        <label class="text-black-50">Stand a chance to get
                                                                            instant 5%
                                                                            Discount by
                                                                            using VISA</label>
                                                                    </div>
                                                                </div>

                                                            </div>

                                                        </div>
                                                    </div>

                                                    <!-- color options -->
                                                    <!-- <div class="col-12 mb-2">
                                                <div class="row " style="margin-top: 15px;">
                                                    <div class="col-md-6" style="margin-top: 15px;">
                                                        <label class="fs-6 mt-1 fw-bold">Colour Options</label>
                                                        <br>
                                                        <button class="btn btn-dark btn-sm">Black</button>
                                                        <button class="btn btn-warning btn-sm">Gold</button>
                                                        <button class="btn btn-primary btn-sm">Blue</button>
                                                    </div>
                                                </div>
                                            </div> -->
                                                    <!-- color options -->
                                                    <hr class="hr1">


                                                    <!-- quantity -->
                                                    <div class="col-12">
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="row">
                                                                    <div class="border border-1 border-secondary rounded overflow-hidden float-start position-relative">
                                                                        <span class="mt-2">Quantity:</span>
                                                                        <input id="qtyinput" style=" height: 40px; outline: none;" class="border-0 fs-6 fw-bold text-start " type="text" pattern="[0-9]*" value="1" />

                                                                        <div class="qty-btns position-absolute">
                                                                            <div class="d-flex flex-column align-items-center border border-1 border-secondary qty-inc">
                                                                                <i class="fas fa-chevron-up" onclick="qtyinc(<?php echo $pd['qty']; ?>);"></i>
                                                                            </div>

                                                                            <div class="d-flex flex-column align-items-center border border-1 border-secondary qty-dec">
                                                                                <i class="fas fa-chevron-down" onclick="qtydec();"></i>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <!-- quantity -->

                                                            <div class="col-12 mt-3">
                                                                <div class="row">
                                                                    <div class="col-lg-3 col-6 d-grid">
                                                                        <button class="btn btn-primary">Add To
                                                                            Cart</button>
                                                                    </div>

                                                                    <div class="col-lg-3 col-6 d-grid">
                                                                        <button onclick="paynow( <?php echo $pid; ?>);" type="submit" id="payhere-payment" class="btn btn-success">Buy Now</button>
                                                                    </div>

                                                                    <div class="col-lg-3 col-4 d-grid">
                                                                        <i class="fas fa-heart mt-2 fs-4 text-black-50"></i>
                                                                    </div>
                                                                </div>
                                                            </div>


                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>






                            <div class="col-12 bg-white">
                                <div class="row d-block me-0 ms-0 mt-4 mb-3 border border-start-0 border-end-0 border-top-0 border-bottom-1 border-primary">
                                    <div class="col-md-6">
                                        <span class="fs-3">Related Items</span>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="row">
                                    <div class="col-8 col-lg-10 offset-2 offset-lg-1 justify-content-center">
                                        <div class="row p-2">

                                            <?php
                                            // $brandrs = database::search("SELECT * FROM `model_has_brand` WHERE `id`='" . $pd["model_has_brand_id"] . "'");
                                            // $bd = $brandrs->fetch_assoc();

                                            // $brand = database::search("SELECT * FROM `brand` WHERE `id`='" . $db["brand_id"] . "'");
                                            $brand = database::search("SELECT `name` FROM brand WHERE id IN (SELECT brand_id FROM model_has_brand WHERE id IN (SELECT product.model_has_brand_id FROM product WHERE id='47'));");
                                            $brandrelated = database::search("SELECT * FROM product WHERE model_has_brand_id IN (SELECT id FROM model_has_brand WHERE brand_id IN (SELECT id FROM brand WHERE `name`='Apple'));");
                                            $bn = $brandrelated->num_rows;

                                            for ($x = 0; $x < $bn; $x++) {

                                                $bd = $brandrelated->fetch_assoc();

                                                $image = database::search("SELECT * FROM `image` WHERE `product_id`='" . $bd["id"] . "'");
                                                $in = $image->num_rows;
                                                $imaged = $image->fetch_assoc();


                                            ?>



                                                <div class="card me-1" style="width: 18rem;">
                                                    <img style="height: 200px;" src="<?php echo $imaged["code"]; ?>" class="card-img-top image-fluid">
                                                    <div class="card-body">
                                                        <h5 class="card-title"><?php echo $bd["title"]; ?></h5>
                                                        <p class="card-text">Rs.<?php echo $bd["price"]; ?>.00</p>
                                                        <a href="#" class="btn btn-primary">Add To Cart</a>
                                                        <a href="<?php echo "singleproductview.php?id=" . ($bd["id"]); ?>" class="btn btn-success">Buy Now</a>
                                                        <a class="me-1 mt-1 fs-5" href=""><i class="fas fa-heart mt-2 fs-4 text-black-50"></i></a>
                                                    </div>
                                                </div>
                                            <?php
                                            }
                                            ?>





                                        </div>
                                    </div>


                                </div>
                            </div>
                            <!-- product details -->
                            <div class="col-12 bg-white">
                                <div class="row d-block me-0 ms-0 mt-4 mb-3 border border-start-0 border-end-0 border-top-0 border-bottom-1 border-primary">
                                    <div class="col-md-6">
                                        <span class="fs-3">Product Details</span>
                                    </div>
                                </div>
                            </div>


                            <?php
                            $mbrs = database::search("SELECT * FROM `brand` WHERE `id` IN (SELECT `brand_id` FROM model_has_brand  WHERE `id`='" . $pd["model_has_brand_id"] . "')");
                            $mbd = $mbrs->fetch_assoc();

                            $mdrs = database::search("SELECT * FROM `model` WHERE `id` IN (SELECT `model_id` FROM model_has_brand  WHERE `id`='" . $pd["model_has_brand_id"] . "')");
                            $md = $mdrs->fetch_assoc();
                            ?>



                            <div class="col-12 bg-white">
                                <div class="row">

                                    <div class="col-12">
                                        <div class="row">

                                            <div class="col-2">
                                                <label class="form-label">Brand</label>
                                            </div>
                                            <div class="col-10">
                                                <label class="form-label"><?php echo $mbd["name"]; ?></label>
                                            </div>


                                        </div>
                                    </div>


                                    <div class="col-12">
                                        <div class="row">

                                            <div class="col-2">
                                                <label class="form-label">Model</label>
                                            </div>
                                            <div class="col-10">
                                                <label class="form-label"><?php echo $md["name"]; ?> </label>
                                            </div>


                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <div class="row">

                                            <div class="col-2">
                                                <label class="form-label">Description</label>
                                            </div>
                                            <div class="col-10 mb-2">
                                                <textarea class="form-control" cols="60" rows="10" readonly><?php echo $pd["description"]; ?></textarea>
                                            </div>


                                        </div>
                                    </div>

                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="col-12 bg-white">
                        <div class="row d-block me-0 ms-0 mt-4 mb-3 border border-start-0 border-end-0 border-top-0 border-bottom-1 border-primary">
                            <div class="col-md-6">
                                <span class="fs-3">Feedbacks....</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="row g-1">
                            <?php
                            $feedbackrs = database::search("SELECT * FROM `feedback` WHERE `product_id`='$pid'");
                            $feedn = $feedbackrs->num_rows;

                            if ($feedn == 0) {
                            ?>

                                <div class="col-12 text-center">
                                    <label class="form-label fs-3 text-black-50">There are no feedbacks for this item</label>
                                </div>

                                <?php
                            } else {

                                for ($y = 0; $y < $feedn; $y++) {
                                    $fd = $feedbackrs->fetch_assoc();

                                    $fu = database::search("SELECT * FROM `user` WHERE `email`='" . $fd["user_email"] . "'");
                                    $ud = $fu->fetch_assoc();

                                ?>


                                    <div class="col-12 col-lg-4 border border-2 border-danger rounded">
                                        <div class="row">
                                            <div class="col-12">
                                                <span class="fs-4 fw-bold text-primary"><?php echo $ud["fname"] . " " . $ud["lname"]; ?></span>
                                            </div>

                                            <div class="col-12">
                                                <span class="fs-4 fw-bold text-dark"><?php echo $fd["feed"]; ?></span>
                                            </div>

                                            <div class="col-12 text-end">
                                                <span class="fs-7 fw-bold text-black-50"><?php echo $fd["date"]; ?></span>
                                            </div>
                                        </div>
                                    </div>


                            <?php
                                }
                            }

                            ?>





                        </div>
                    </div>


                </div>
                <?php require "footer.php"; ?>
            </div>


            <script type="text/javascript" src="https://www.payhere.lk/lib/payhere.js"></script>
            <script src="script.js"></script>
        </body>

        </html>

    <?php
    }
    require "connection.php";
    session_start();
    $umail = $_SESSION["u"]["email"];

    if (isset($_GET["id"])) {
        $pid = $_GET["id"];
        // echo $pid;
        $productrs = database::search("SELECT * FROM `product` WHERE `id`='$pid' ");
        $pn = $productrs->num_rows;
        if ($pn == 1) {

            $pd = $productrs->fetch_assoc();
        }


    ?>

        <!DOCTYPE html>
        <html lang="en">

        <head>
            <meta charset="UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <title>Single product</title>

            <link rel="stylesheet" href="bootstrap.css">
            <link rel="stylesheet" href="style.css">
            <link rel="icon" href="resources/logo.svg">


            <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css" /> -->
            <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" />
            <script src="jquery.min.js"></script>
            <script src="bootstrap.js"></script>
            <script src="bootstrap.bundle.js"></script>
            <!-- <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/js/bootstrap.min.js"></script> -->
            <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script> -->
        </head>

        <body>

            <div class="container-fluid">

                <?php
                require "header.php";
                ?>


                <div class="row">
                    <div class="col-12 mt-0 singleproduct">
                        <div class="row">
                            <div class="bg-white" style="padding: 11px;">
                                <div class="row">
                                    <div class="col-lg-2 order-lg-1 order-2">
                                        <ul>
                                            <?php
                                            $image = database::search("SELECT * FROM `image` WHERE `product_id`='$pid'");
                                            $in = $image->num_rows;
                                            $image1;

                                            if (!empty($in)) {


                                                for ($x = 0; $x < $in; $x++) {
                                                    $d = $image->fetch_assoc();

                                                    if ($x == 0) {
                                                        $image1 = $d["code"];
                                                    }

                                            ?>

                                                    <li class="d-flex flex-column justify-content-center align-items-center border border-1 border-secondary">
                                                        <img style="background-size: contain;" class="mt-1 mb-1" height="140px" src="<?php echo $d["code"]; ?>" id="pimg<?php echo $x; ?>" onclick="loadmainimg(<?php echo $x; ?>);">
                                                    </li>

                                                <?php
                                                }
                                            } else {
                                                ?>
                                                <li class="d-flex flex-column justify-content-center align-items-center border border-1 border-secondary">
                                                    <img class="mt-1 mb-1" height="140px" src="resources/2561351_camera_icon.svg" alt="">
                                                </li>
                                                <li class="d-flex flex-column justify-content-center align-items-center border border-1 border-secondary">
                                                    <img height="140px" class="mt-1 mb-1" src="resources/2561351_camera_icon.svg" alt="">
                                                </li>
                                                <li class="d-flex flex-column justify-content-center align-items-center border border-1 border-secondary">
                                                    <img height="140px" class="mt-1 mb-1" src="resources/2561351_camera_icon.svg" alt="">
                                                </li>

                                            <?php

                                            }
                                            ?>



                                        </ul>
                                    </div>

                                    <div class="col-lg-4 order-2 order-lg-1 d-none d-lg-block">
                                        <div class=" align-items-center border border-1 border-secondary p-3">
                                            <div id="mainimg" style="background-image: url('<?php echo $image1; ?>'); background-repeat: no-repeat; background-size: contain; height: 450px;">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-6 order-3">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="row">


                                                    <div class="col-12">
                                                        <nav>
                                                            <ol class="d-flex flex-wrap mb-0 list-unstyled bg-white rounded">
                                                                <li class="breadcrumb-item"><a href="home.php">Home</a></li>

                                                                <li class="breadcrumb-item active"><a class="text-black-50  text-decoration-none" href="#">Single
                                                                        View</a></li>
                                                            </ol>
                                                        </nav>

                                                    </div>

                                                    <div class="col-4 col-lg-12">
                                                        <label class="form-label fs-4 fw-bold mt-0"><?php echo $pd["title"]; ?></label>
                                                    </div>

                                                    <div class="col-8 col-lg-12 mt-lg-1">
                                                        <span class="badge">
                                                            <i class="fa fa-star text-warning fs-6"></i>&nbsp;
                                                            <label class="text-dark fs-6">4.5 Star</label>
                                                            <label class="text-dark fs-6"> | 35 Ratings & 45 Reviews</label>
                                                        </span>
                                                    </div>

                                                    <div class="col-12">
                                                        <label class="fw-bold mt-1 fs-4 ">Rs<?php echo $pd["price"]; ?>.00</label>

                                                        <label class="fw-bold mt-1 fs-6 text-danger "><del>Rs.<?php $a = $pd["price"];
                                                                                                                $newv = ($a / 100) * 5;
                                                                                                                $val = $a + $newv;
                                                                                                                echo $val; ?></del></label>
                                                    </div>

                                                    <hr class="hr1">

                                                    <!-- <div class="col-12">
                                                <label class="text-primary fs-4 "><b>Warranty:</b> 6 Months
                                                    Warranty</label>
                                                <br>
                                                <label class="text-primary fs-4 "><b>Policy:</b> 1 Month
                                                    Return Policy</label>
                                                <br>
                                                <label class="text-primary fs-4 "><b>In Stock:</b>
                                                    <?php echo $pd["qty"]; ?> Items Left</label>
                                            </div>
                                            <hr class="hr1"> -->
                                                    <div class="col-12 col-lg-2">

                                                        <a href="messages.php?email=" +<?php echo $umail; ?> class="btn btn-danger">Contact Seller</a>
                                                    </div>


                                                    <div class="col-lg-5 col-12 border border-dark mb-3">
                                                        <?php
                                                        $users = database::search("SELECT * FROM `user` WHERE `email`='" . $pd["user_email"] . "'");
                                                        $userd = $users->fetch_assoc();
                                                        ?>
                                                        <label class="text-dark fs-6 "><b>Seller:
                                                            </b><?php echo $userd["fname"] . "  " . $userd["lname"]; ?></label>
                                                        <br>
                                                        <label class="text-success fs-7 "><b>E-mail</b>
                                                            <?php echo $userd["email"]; ?></label>
                                                        <br>
                                                        <label class="text-dark fs-7 "><b>Contact: </b>
                                                            <?php echo $userd["mobile"]; ?></label>
                                                    </div>



                                                    <hr class="hr1">


                                                    <div class="col-12 mt-3 mb-3">
                                                        <div class="row">
                                                            <div class="col-lg-9 rounded border border-2 border-success mt-1">
                                                                <div class="row">
                                                                    <div class="col-md-3 col-sm-3 col-lg-1">
                                                                        <img src="resources/single product view/pricetag.png">
                                                                    </div>

                                                                    <div class="col-md-9 col-lg-11 col-sm-9 pe-4 mt-1">
                                                                        <label class="text-black-50">Stand a chance to get
                                                                            instant 5%
                                                                            Discount by
                                                                            using VISA</label>
                                                                    </div>
                                                                </div>

                                                            </div>

                                                        </div>
                                                    </div>

                                                    <!-- color options -->
                                                    <!-- <div class="col-12 mb-2">
                                                <div class="row " style="margin-top: 15px;">
                                                    <div class="col-md-6" style="margin-top: 15px;">
                                                        <label class="fs-6 mt-1 fw-bold">Colour Options</label>
                                                        <br>
                                                        <button class="btn btn-dark btn-sm">Black</button>
                                                        <button class="btn btn-warning btn-sm">Gold</button>
                                                        <button class="btn btn-primary btn-sm">Blue</button>
                                                    </div>
                                                </div>
                                            </div> -->
                                                    <!-- color options -->
                                                    <hr class="hr1">


                                                    <!-- quantity -->
                                                    <div class="col-12">
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="row">
                                                                    <div class="border border-1 border-secondary rounded overflow-hidden float-start position-relative">
                                                                        <span class="mt-2">Quantity:</span>
                                                                        <input id="qtyinput" style=" height: 40px; outline: none;" class="border-0 fs-6 fw-bold text-start " type="text" pattern="[0-9]*" value="1" />

                                                                        <div class="qty-btns position-absolute">
                                                                            <div class="d-flex flex-column align-items-center border border-1 border-secondary qty-inc">
                                                                                <i class="fas fa-chevron-up" onclick="qtyinc(<?php echo $pd['qty']; ?>);"></i>
                                                                            </div>

                                                                            <div class="d-flex flex-column align-items-center border border-1 border-secondary qty-dec">
                                                                                <i class="fas fa-chevron-down" onclick="qtydec();"></i>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <!-- quantity -->

                                                            <div class="col-12 mt-3">
                                                                <div class="row">
                                                                    <div class="col-lg-3 col-6 d-grid">
                                                                        <button class="btn btn-primary">Add To
                                                                            Cart</button>
                                                                    </div>

                                                                    <div class="col-lg-3 col-6 d-grid">
                                                                        <button onclick="paynow( <?php echo $pid; ?>);" type="submit" id="payhere-payment" class="btn btn-success">Buy Now</button>
                                                                    </div>

                                                                    <div class="col-lg-3 col-4 d-grid">
                                                                        <i class="fas fa-heart mt-2 fs-4 text-black-50"></i>
                                                                    </div>
                                                                </div>
                                                            </div>


                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>






                            <div class="col-12 bg-white">
                                <div class="row d-block me-0 ms-0 mt-4 mb-3 border border-start-0 border-end-0 border-top-0 border-bottom-1 border-primary">
                                    <div class="col-md-6">
                                        <span class="fs-3">Related Items</span>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="row">
                                    <div class="col-8 col-lg-10 offset-2 offset-lg-1 justify-content-center">
                                        <div class="row p-2">

                                            <?php
                                            // $brandrs = database::search("SELECT * FROM `model_has_brand` WHERE `id`='" . $pd["model_has_brand_id"] . "'");
                                            // $bd = $brandrs->fetch_assoc();

                                            // $brand = database::search("SELECT * FROM `brand` WHERE `id`='" . $db["brand_id"] . "'");
                                            $brand = database::search("SELECT `name` FROM brand WHERE id IN (SELECT brand_id FROM model_has_brand WHERE id IN (SELECT product.model_has_brand_id FROM product WHERE id='47'));");
                                            $brandrelated = database::search("SELECT * FROM product WHERE model_has_brand_id IN (SELECT id FROM model_has_brand WHERE brand_id IN (SELECT id FROM brand WHERE `name`='Apple'));");
                                            $bn = $brandrelated->num_rows;

                                            for ($x = 0; $x < $bn; $x++) {

                                                $bd = $brandrelated->fetch_assoc();

                                                $image = database::search("SELECT * FROM `image` WHERE `product_id`='" . $bd["id"] . "'");
                                                $in = $image->num_rows;
                                                $imaged = $image->fetch_assoc();


                                            ?>



                                                <div class="card me-1" style="width: 18rem;">
                                                    <img style="height: 200px;" src="<?php echo $imaged["code"]; ?>" class="card-img-top image-fluid">
                                                    <div class="card-body">
                                                        <h5 class="card-title"><?php echo $bd["title"]; ?></h5>
                                                        <p class="card-text">Rs.<?php echo $bd["price"]; ?>.00</p>
                                                        <a href="#" class="btn btn-primary">Add To Cart</a>
                                                        <a href="<?php echo "singleproductview.php?id=" . ($bd["id"]); ?>" class="btn btn-success">Buy Now</a>
                                                        <a class="me-1 mt-1 fs-5" href=""><i class="fas fa-heart mt-2 fs-4 text-black-50"></i></a>
                                                    </div>
                                                </div>
                                            <?php
                                            }
                                            ?>





                                        </div>
                                    </div>


                                </div>
                            </div>
                            <!-- product details -->
                            <div class="col-12 bg-white">
                                <div class="row d-block me-0 ms-0 mt-4 mb-3 border border-start-0 border-end-0 border-top-0 border-bottom-1 border-primary">
                                    <div class="col-md-6">
                                        <span class="fs-3">Product Details</span>
                                    </div>
                                </div>
                            </div>


                            <?php
                            $mbrs = database::search("SELECT * FROM `brand` WHERE `id` IN (SELECT `brand_id` FROM model_has_brand  WHERE `id`='" . $pd["model_has_brand_id"] . "')");
                            $mbd = $mbrs->fetch_assoc();

                            $mdrs = database::search("SELECT * FROM `model` WHERE `id` IN (SELECT `model_id` FROM model_has_brand  WHERE `id`='" . $pd["model_has_brand_id"] . "')");
                            $md = $mdrs->fetch_assoc();
                            ?>



                            <div class="col-12 bg-white">
                                <div class="row">

                                    <div class="col-12">
                                        <div class="row">

                                            <div class="col-2">
                                                <label class="form-label">Brand</label>
                                            </div>
                                            <div class="col-10">
                                                <label class="form-label"><?php echo $mbd["name"]; ?></label>
                                            </div>


                                        </div>
                                    </div>


                                    <div class="col-12">
                                        <div class="row">

                                            <div class="col-2">
                                                <label class="form-label">Model</label>
                                            </div>
                                            <div class="col-10">
                                                <label class="form-label"><?php echo $md["name"]; ?> </label>
                                            </div>


                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <div class="row">

                                            <div class="col-2">
                                                <label class="form-label">Description</label>
                                            </div>
                                            <div class="col-10 mb-2">
                                                <textarea class="form-control" cols="60" rows="10" readonly><?php echo $pd["description"]; ?></textarea>
                                            </div>


                                        </div>
                                    </div>

                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="col-12 bg-white">
                        <div class="row d-block me-0 ms-0 mt-4 mb-3 border border-start-0 border-end-0 border-top-0 border-bottom-1 border-primary">
                            <div class="col-md-6">
                                <span class="fs-3">Feedbacks....</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="row g-1">
                            <?php
                            $feedbackrs = database::search("SELECT * FROM `feedback` WHERE `product_id`='$pid'");
                            $feedn = $feedbackrs->num_rows;

                            if ($feedn == 0) {
                            ?>

                                <div class="col-12 text-center">
                                    <label class="form-label fs-3 text-black-50">There are no feedbacks for this item</label>
                                </div>

                                <?php
                            } else {

                                for ($y = 0; $y < $feedn; $y++) {
                                    $fd = $feedbackrs->fetch_assoc();

                                    $fu = database::search("SELECT * FROM `user` WHERE `email`='" . $fd["user_email"] . "'");
                                    $ud = $fu->fetch_assoc();

                                ?>


                                    <div class="col-12 col-lg-4 border border-2 border-danger rounded">
                                        <div class="row">
                                            <div class="col-12">
                                                <span class="fs-4 fw-bold text-primary"><?php echo $ud["fname"] . " " . $ud["lname"]; ?></span>
                                            </div>

                                            <div class="col-12">
                                                <span class="fs-4 fw-bold text-dark"><?php echo $fd["feed"]; ?></span>
                                            </div>

                                            <div class="col-12 text-end">
                                                <span class="fs-7 fw-bold text-black-50"><?php echo $fd["date"]; ?></span>
                                            </div>
                                        </div>
                                    </div>


                            <?php
                                }
                            }

                            ?>





                        </div>
                    </div>


                </div>
                <?php require "footer.php"; ?>
            </div>


            <script type="text/javascript" src="https://www.payhere.lk/lib/payhere.js"></script>
            <script src="script.js"></script>
        </body>

        </html>

    <?php
    } else {
    ?>
        <script>
            alert("Sign In First");
        </script>

<?php
    }
}
