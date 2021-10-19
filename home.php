<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-shop</title>

    <link rel="icon" href="resources/logo.svg">
    <link rel="stylesheet" href="bootstrap.css">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
</head>

<body>

    <div class="container-fluid">

        <!-- header -->
        <div class="row">
            <div class="col-12">
                <?php
                require "header.php";
                ?>
                <hr class="hr1">

                <div class="row">
                    <!-- logo -->
                    <div class="offset-lg-1  col-8 offset-5 col-lg-2 logoimg"></div>


                    <!-- search field -->
                    <div class="col-lg-6 col-8  mt-4">
                        <div class="input-group mb-3">
                            <input id="basicsearch" type="text" class="form-control" aria-label="Text input with dropdown button">
                            <select class="btn btn-outline-primary " id="basiccategory">
                                <option value="0">Select Category</option>
                                <?php
                                require "connection.php";
                                $rs = database::search("SELECT * FROM  `category`");
                                $n = $rs->num_rows;

                                for ($x = 0; $x < $n; $x++) {
                                    $d = $rs->fetch_assoc();
                                ?>
                                    <option value="<?php echo $d["id"]; ?>" class="dropdown-item" href="#">
                                        <?php echo $d["name"]; ?></option>
                                <?php
                                }
                                ?>

                            </select>
                            <!-- <button class="btn btn-outline-primary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">Category</button>
                            <ul class="dropdown-menu dropdown-menu-end">
                              

                            </ul> -->
                        </div>

                    </div>

                    <!-- button -->
                    <div class="col-2 d-grid gap-2">
                        <button onclick="basicsearch();" class="btn btn-primary mt-4 searchbutton">Search</button>
                    </div>

                    <!-- advanced options -->
                    <div class="col-1 ms-2 ms-lg-0 mt-4">
                        <a class="link-secondary advanced-link" href="#">Advanced</a>
                    </div>
                </div>
                <hr class="hr1">

                <!-- carousel slider -->

                <div class="col-12 d-none d-lg-block">

                    <div class="row">
                        <div id="carouselmain" class="col-8 offset-2 carousel slide" data-bs-ride="carousel">
                            <div class="carousel-indicators">
                                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
                                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
                            </div>
                            <div class="carousel-inner">
                                <div class="carousel-item active">
                                    <img src="resources/posterimg.jpg" class="d-block slider-img1" alt="...">
                                    <div class="carousel-caption d-none d-md-block slider-caption slider1-cap">
                                        <h5 class="slider-title">Welcome To E-shop</h5>
                                        <p class="slider-p">Your No.01 option for the best Deals!</p>
                                    </div>
                                </div>
                                <div class="carousel-item">
                                    <img src="resources/posterimg2.jpg"" class=" d-block w-100" alt="...">

                                </div>
                                <div class="carousel-item">
                                    <img src="resources/posterimg3.jpg" class="d-block w-100" alt="...">
                                    <div class="carousel-caption d-none d-md-block slider3-cap">
                                        <h5 class="slider-title">Shop at your own Will!</h5>
                                        <p class="slider-p">Experience the best prices with outstanding Quality</p>
                                    </div>
                                </div>
                            </div>
                            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Previous</span>
                            </button>
                            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Next</span>
                            </button>
                        </div>
                    </div>
                </div>


                <!-- product title view -->
                <div class="row mt-5 mb-1">

                    <?php

                    $rs = database::search("SELECT * FROM  `category`");
                    $n = $rs->num_rows;


                    for ($x = 0; $x < $n; $x++) {
                        $c = $rs->fetch_assoc();

                    ?>
                        <div class="col-12" id="pcat">
                            <a class="link-dark product-view-link" href="#"><?php echo $c["name"]; ?></a>&nbsp;&nbsp;
                            <a class="link-dark see-all" href="#">See All &rarr;</a>
                        </div>
                        <?php

                        $resultset = database::search("SELECT * FROM `product` WHERE category_id='" . $c["id"] . "' ORDER BY `datetime_added` DESC LIMIT 5 OFFSET 0 ");
                        ?>
                        <div class="row border border-info mb-5">
                            <div class="row" id="pdiv">
                                <div class="row" id="pdetails">

                                    <?php
                                    $nr = $resultset->num_rows;
                                    for ($y = 0; $y < $nr; $y++) {
                                        $pro = $resultset->fetch_assoc();
                                    ?>



                                        <div class="card col-6 col-lg-2 mt-1 mb-1 ms-3" style="width: 18rem;">

                                            <?php
                                            $pimage = database::search("SELECT * FROM `image` WHERE product_id='" . $pro["id"] . "' ");
                                            $imgrow = $pimage->fetch_assoc();
                                            ?>

                                            <img src="<?php echo $imgrow["code"]; ?>" class="card-img-top cardimg" alt="...">
                                            <div class="card-body">
                                                <h5 class="card-title"><?php echo $pro["title"]; ?><span class="badge bg-primary">New</span>
                                                </h5>
                                                <span class="card-text text-primary">Rs.<?php echo $pro["price"]; ?></span>
                                                <br>
                                                <?php
                                                if ((int)$pro['qty'] > 0) {
                                                ?>

                                                    <span class="card-text text-warning">In Stock</span>
                                                <?php
                                                } else {
                                                ?>

                                                    <span class="card-text text-warning">Out Of Stock</span>
                                                <?php
                                                }
                                                ?>


                                                <input id="qtytext<?php echo $pro['id']; ?>" type="number" class="form-control mb-2" value="1" min="0">
                                                <a href="<?php echo "singleproductview.php?id=" . ($pro["id"]); ?>" class="btn btn-success">Buy Now</a>
                                                <a onclick="addtocart(<?php echo $pro['id']; ?>);" class="btn btn-danger">Add To
                                                    Cart</a>
                                                <a id="heart" onclick="addtowishlist(<?php echo $pro['id']; ?>);" href="#" class="btn btn-secondary"><i class="bi bi-heart-fill"></i></a>
                                            </div>
                                        </div>

                                    <?php
                                    }
                                    ?>

                                </div>
                            </div>
                        </div>
                    <?php
                    }
                    ?>


                </div>

                <!-- product view -->
                <!-- <div class="row border border-info mb-5">
                    <div class="offset-lg-1 col-12 col-lg-12">
                        <div class="row">

                            


                            <div class="card col-6 col-lg-2 mt-1 mb-1 ms-1" style="width: 18rem;">
                                <img src="resources/mobile images/htc_u.jpg" class="card-img-top cardimg" alt="...">
                                <div class="card-body">
                                    <h5 class="card-title">HTC U Ultra <span class="badge bg-primary">New</span></h5>
                                    <span class="card-text text-primary">Rs.49580.00</span>
                                    <br>
                                    <span class="card-text text-warning">In Stock</span>
                                    <input type="number" class="form-control mb-2" value="1" min="0">
                                    <a href="#" class="btn btn-success">Buy Now</a>
                                    <a href="#" class="btn btn-danger">Add To Cart</a>
                                </div>
                            </div>

                            <div class="card col-6 col-lg-2 mt-1 mb-1 ms-1" style="width: 18rem;">
                                <img src="resources/mobile images/huawei_p20.png" class="card-img-top cardimg"
                                    alt="...">
                                <div class="card-body">
                                    <h5 class="card-title">Huawei P20 <span class="badge bg-primary">New</span></h5>
                                    <span class="card-text text-primary">Rs.59580.00</span>
                                    <br>
                                    <span class="card-text text-warning">In Stock</span>
                                    <input type="number" class="form-control mb-2" value="1" min="0">
                                    <a href="#" class="btn btn-success">Buy Now</a>
                                    <a href="#" class="btn btn-danger">Add To Cart</a>
                                </div>
                            </div>

                            <div class="card col-6 col-lg-2 mt-1 mb-1 ms-1" style="width: 18rem;">
                                <img src="resources/mobile images/iphone12.jpg" class="card-img-top cardimg" alt="...">
                                <div class="card-body">
                                    <h5 class="card-title">Iphone 12 Pro <span class="badge bg-primary">New</span></h5>
                                    <span class="card-text text-primary">Rs.119580.00</span>
                                    <br>
                                    <span class="card-text text-warning">In Stock</span>
                                    <input type="number" class="form-control mb-2" value="1" min="0">
                                    <a href="#" class="btn btn-success">Buy Now</a>
                                    <a href="#" class="btn btn-danger">Add To Cart</a>
                                </div>
                            </div>

                            <div class="card col-6 col-lg-2 mt-1 mb-1 ms-1" style="width: 18rem;">
                                <img src="resources/mobile images/oppo_a95.png" class="card-img-top cardimg" alt="...">
                                <div class="card-body">
                                    <h5 class="card-title">Oppo A95 <span class="badge bg-primary">New</span></h5>
                                    <span class="card-text text-primary">Rs.34500.00</span>
                                    <br>
                                    <span class="card-text text-warning">In Stock</span>
                                    <input type="number" class="form-control mb-2" value="1" min="0">
                                    <a href="#" class="btn btn-success">Buy Now</a>
                                    <a href="#" class="btn btn-danger">Add To Cart</a>
                                </div>
                            </div>

                            <div class="card col-6 col-lg-2 mt-1 mb-1 ms-1" style="width: 18rem;">
                                <img src="resources/mobile images/xperia_10.jpg" class="card-img-top cardimg" alt="...">
                                <div class="card-body">
                                    <h5 class="card-title">Xperia 10 <span class="badge bg-primary">New</span></h5>
                                    <span class="card-text text-primary">Rs.35000.00</span>
                                    <br>
                                    <span class="card-text text-warning">In Stock</span>
                                    <input type="number" class="form-control mb-2" value="1" min="0">
                                    <a href="#" class="btn btn-success">Buy Now</a>
                                    <a href="#" class="btn btn-danger">Add To Cart</a>
                                </div>
                            </div>


                         

                </div>

                    </div>
                </div>  -->

                <!-- cards end -->
                <!-- footer -->
                <?php
                require "footer.php";
                ?>
                <!-- footer end -->
            </div>
        </div>

    </div>
    <script src="bootstrap.bundle.js"></script>
    <script src="script.js"></script>
</body>

</html>