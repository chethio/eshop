<?php
session_start();
require "connection.php";

if (isset($_SESSION["u"])) {
    $email = $_SESSION["u"]["email"];

    $total = "0";
    $subtotal = "0";
    $shipping = "0";


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-shop|Cart</title>
    <link rel="icon" href="resources/logo.svg">
    <link rel="stylesheet" href="bootstrap.css">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
</head>

<body>

    <div class="container-fluid">



        <?php require "header.php" ?>
        <div class="row">


            <div class="col-12" style="background-color: #E3E5E4;">
                <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Library</li>
                    </ol>
                </nav>
            </div>


            <div class="col-12 border border-secondary rounded mb-3">
                <div class="row">
                    <div class="col-12">
                        <label class="form-label fs-1 fw-bolder">Basket <i class="bi bi-cart3"></i></label>
                    </div>
                    <div class="col-12 col-lg-6">
                        <hr class="hr1">
                    </div>

                    <div class="col-12">
                        <div class="row">
                            <div class="offset-0 offset-lg-2 col-12 col-lg-6 mb-3">
                                <input type="text" class="form-control" placeholder="Search In Cart">
                            </div>

                            <div class=" col-12 col-lg-2 d-grid mb-3">
                                <button class="btn btn-outline-primary">Search</button>
                            </div>

                        </div>
                    </div>

                    <div class="col-12">
                        <hr class="hr1">
                    </div>
                    <?php
                        $cartrs = database::search("SELECT * FROM `cart` ;");
                        $cn = $cartrs->num_rows;

                        if ($cn == 0) {
                        ?>

                    <!-- empty view -->
                    <div class="col-12">
                        <div class="row">
                            <div class="col-12 emptycart"></div>
                            <div class="col-12 text-center">
                                <label class="form-label fs-1 fw-bolder">You Have No Items In Your Cart</label>
                            </div>
                            <div class="offset-0 offset-lg-4 col-lg-4 col-12 d-grid mb-4">
                                <a href="home.php" class="btn btn-primary fs-3">Start Shopping</a>
                            </div>
                        </div>
                    </div>
                    <!-- empty view -->

                    <?php
                        } else {

                        ?>

                    <div class="col-12 col-lg-9">
                        <div class="row">
                            <?php
                                    while ($cr = $cartrs->fetch_assoc()) {

                                        $productrs = database::search("SELECT * FROM product WHERE `id`='" . $cr["product_id"] . "'");
                                        $pr = $productrs->fetch_assoc();

                                    ?> <?php $total = $total + ($pr["price"] * $cr["qty"]);

                                        $addressrs = database::search("SELECT * FROM `user_has_address` WHERE `user_email`='$email'");
                                        $ar = $addressrs->fetch_assoc();

                                        $cityid = $ar["city_id"];

                                        $districtrs = database::search("SELECT * FROM `city` WHERE `id`='$cityid'");
                                        $dr = $districtrs->fetch_assoc();

                                        $districtid = $dr["district_id"];

                                        $ship = "0";

                                        // seeing whether the user is in colombo
                                        if ($districtid == "4") {
                                            $ship = $pr["delivery_fee_colombo"];
                                            $shipping = $shipping + $pr["delivery_fee_colombo"];
                                        } else {
                                            $ship = $pr["delivery_fee_other"];
                                            $shipping = $shipping + $pr["delivery_fee_other"];
                                        }

                                        // echo $total;
                                        // echo $shipping;

                                        $sellerrs = database::search("SELECT * FROM user WHERE `email`='" . $pr["user_email"] . "'");
                                        $sr = $sellerrs->fetch_assoc();
                                        ?>

                            <div class="card mb-3 mx-0  col-12">
                                <div class="row g-0">
                                    <div class="col-md-12 mt-3 mb-3">
                                        <div class="row">
                                            <div class="col-12">
                                                <span class="fw-bold text-black-50 fs-5">Seller :</span>&nbsp;
                                                <span
                                                    class="fw-bold text-black fs-7"><?php echo $sr["fname"] . " " . $sr["lname"]; ?></span>
                                            </div>
                                        </div>
                                    </div>
                                    <hr>

                                    <div class="col-md-4 mt-3">

                                        <?php
                                                    $imagers = database::search("SELECT * FROM `image` WHERE `product_id`='" . $pr["id"] . "' ");
                                                    $in = $imagers->num_rows;
                                                    $arr;

                                                    for ($p = 0; $p < $in; $p++) {
                                                        $ir = $imagers->fetch_assoc();
                                                        $arr["$p"] = $ir["code"];
                                                    }

                                                    $colors = database::search("SELECT * FROM `color` WHERE `id`='" . $pr["color_id"] . "'");
                                                    $clr = $colors->fetch_assoc();

                                                    $conditionrs = database::search("SELECT * FROM `condition` WHERE `id`='" . $pr["condition_id"] . "'");
                                                    $conr = $conditionrs->fetch_assoc();


                                                    ?>
                                        <img onmouseover="detailsmodal(<?php echo $cr['id'] ?>);" style="height: 150px;"
                                            src="<?php echo $arr[0]; ?>" class="img-fluid rounded-start">
                                    </div>
                                    <div class="col-md-5">
                                        <div class="card-body">
                                            <h3 class="card-title"><?php echo $pr["title"]; ?></h3>
                                            <span class="fw-bold text-black-50 ">Colour:
                                                <?php echo $clr["name"]; ?></span>&nbsp;
                                            |
                                            &nbsp;<span class="fw-bold text-black-50 ">Condition :
                                                <?php echo $conr["name"]; ?></span>
                                            <br>
                                            <span class="fw-bold text-black-50 fs-5">Price : </span>&nbsp;
                                            <span
                                                class="fw-bold text-black fs-5 fw-bold">Rs.<?php echo $pr["price"]; ?>.00</span>&nbsp;
                                            <br>
                                            <span class="fw-bold text-black-50 fs-5">Quantity : </span>&nbsp;

                                            <input type="number"
                                                class="mt-3 border border-2 border-secondary fs-4 fw-bold px-3 cartquantity"
                                                value="<?php echo $cr["qty"]; ?>" min="0">
                                            <br>

                                            <span class="fw-bold text-black-50 fs-5">Delivery Fee: </span>&nbsp;

                                            <span
                                                class="fw-bold text-black fs-5 fw-bold">Rs.<?php echo $ship; ?>.00</span>&nbsp;


                                        </div>
                                    </div>

                                    <div class="col-md-3 mt-4">
                                        <div class="card-body d-grid">
                                            <a href="" class="btn btn-outline-success mb-2">Pay</a>

                                            <a onclick="removefromcart(<?php echo $cr['id'] ?>);"
                                                class="btn btn-outline-danger mb-2">Remove</a>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="col-md-12 mt-3 mb-3">
                                        <div class="row">
                                            <div class="col-6">
                                                <span class="fw-bold fs-5 text-black-50">Requested Total <i
                                                        class="bi bi-info-circle"></i></span>
                                            </div>

                                            <div class="col-6 text-end">
                                                <span
                                                    class="fw-bold fs-5 text-black-50">Rs.<?php echo ($pr["price"] * $cr["qty"] + $shipping); ?>.00
                                                    <i class="bi bi-info-circle"></i></span>
                                            </div>
                                        </div>
                                    </div>

                                </div>

                            </div>
                            <?php
                                    }
                                    ?>
                        </div>
                    </div>





                    <div class="col-12 col-lg-3">
                        <div class="row">
                            <div class="col-12">
                                <label class="form-label fs-3 fw-bold">Summary</label>
                            </div>

                            <div class="col-12">
                                <hr>
                            </div>

                            <div class="col-6">
                                <span class="fw-bold text-black-50 fs-5">Items (<?php echo $cn; ?>)</span>
                            </div>

                            <div class="col-6 text-end">
                                <span class="fw-bold text-black-50 fs-5">Rs.<?php echo $total; ?>.00</span>
                            </div>


                            <div class="col-6 mt-3">
                                <span class="fw-bold text-black-50 fs-5">Shipping</span>
                            </div>

                            <div class="col-6 text-end mt-3">
                                <span class="fw-bold text-black-50 fs-5">Rs.<?php echo $shipping; ?>.00</span>
                            </div>

                            <div class="col-12 mt-3">
                                <hr>
                            </div>


                            <div class="col-6 mt-3">
                                <span class="fw-bold fs-4">Total</span>
                            </div>

                            <div class="col-6 text-end mt-3">
                                <span class="fw-bold fs-4">Rs.<?php echo $total + $shipping; ?>.00</span>
                            </div>

                            <div class="col-12 mt-3 mb-3 d-grid">
                                <button class="btn btn-primary fs-5 fw-bold">Checkout</button>
                            </div>
                        </div>
                    </div>

                    <?php
                        }
                        ?>
                </div>


            </div>







        </div>

        <?php
            require "footer.php";
            ?>
    </div>

    <script src="script.js"></script>
</body>

</html>

<?php
}
?>