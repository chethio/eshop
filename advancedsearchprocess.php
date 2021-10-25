<?php
require "connection.php";
if (!empty($_POST["k"])) {

    $keyword = $_POST["k"];
    $category = $_POST["c"];
    $brand = $_POST["b"];
    $model = $_POST["m"];
    $condition = $_POST["con"];
    $color = $_POST["clr"];
    $pricefrom = $_POST["pf"];
    $priceto = $_POST["pt"];

    if (isset($_GET["page"])) {
        $page_no = $_GET["page"];
    } else {

        $page_no = 1;
    }



    $productrs = database::search("SELECT * FROM `product` WHERE `title` LIKE '%" . $keyword . "%'");
    $n = $productrs->num_rows;


    // $r = $productrs->fetch_assoc();
    $result_per_page = 4;

    $number_of_pages = ceil($n / $result_per_page);

    $firstpage_result = ((int) $page_no - 1) * $result_per_page;

    $product = database::search("SELECT * FROM `product` WHERE `title` LIKE '%" . $keyword . "%' LIMIT " . $result_per_page . " OFFSET " . $firstpage_result . " ");
    $pnum = $product->num_rows;
    for ($y = 0; $y < $pnum; $y++) {
        $r = $product->fetch_assoc();

?>

        <!-- product card -->
        <div class="card mb-3 col-12 col-lg-5 mt-3 ms-lg-4 ms-0">
            <div class="row g-0">
                <div class="col-md-4 mt-3">
                    <?php
                    $imgrs = database::search("SELECT * FROM `image` WHERE `product_id`='" . $r["id"] . "'");
                    $in = $imgrs->num_rows;
                    $arr;

                    $imgd = $imgrs->fetch_assoc();

                    ?>
                    <img src="<?php echo $imgd["code"]; ?>" class="img-fluid rounded-start" alt="...">



                </div>
                <div class="col-md-8">
                    <div class="card-body">
                        <h5 class="card-title fw-bold"><?php echo $r["title"]; ?></h5>
                        <span class="card-text text-primary fw-bold">Rs.<?php echo $r["price"]; ?>.00</span>
                        <br>
                        <span class="card-text text-success fw-bold"><?php echo $r["qty"]; ?>
                            Items
                            Left</span>
                        <br>

                        <dic class="col-12">
                            <div class="row">
                                <div class="col-lg-6 col-12">
                                    <a class="btn btn-primary d-grid" href="#">Buy Now</a>
                                </div>

                                <div class="col-lg-6 col-12 mt-1 mt-lg-0">
                                    <a class="btn btn-success d-grid" href="#">Add To Cart
                                    </a>
                                </div>
                            </div>
                        </dic>


                    </div>
                </div>
            </div>
        </div>
        <!-- product card -->

    <?php


    }
    ?>

    <!-- pagination -->
    <div class="col-12">
        <div class="row justify-content-center">
            <div class="offsey-4 col-4 text-center">
                <div class="offset-3 mb-5 pagination">
                    <a href="<?php
                                if ($page_no <= 1) {
                                    echo "#";
                                } else {
                                    echo "?page=" . ($page_no - 1);
                                }
                                ?>">&laquo;</a>
                    <?php
                    for ($page = 1; $page <= $number_of_pages; $page++) {
                        if ($page == $page_no) {
                    ?>
                            <a class="ms-1 active" href="<?php echo "?page=" . ($page); ?>"><?php echo $page; ?></a>
                        <?php


                        } else {
                        ?>
                            <a class="ms-1" href="<?php echo "?page=" . ($page); ?>"><?php echo $page; ?></a>
                    <?php
                        }
                    }
                    ?>

                    <!-- <a class="active" href="#">2</a> -->

                    <a href="<?php
                                if ($page_no >= $number_of_pages) {
                                    echo "#";
                                } else {

                                    echo "?page=" . ($page_no + 1);
                                }
                                ?>">&raquo;</a>

                </div>
            </div>
        </div>



    <?php

    if (!empty($keyword) && $category != "0") {
        $c = database::search("SELECT * FROM `product` WHERE `title` LIKE '%" . $keyword . "%' AND `category_id`='$category'");
    } else if (!empty($keyword) && $brand != "0") {
        $b = database::search("SELECT * FROM `product` WHERE `title` LIKE '%" . $keyword . "%' AND `model_has_brand_id` IN(SELECT `id` FROM `model_has_brand` WHERE `brand_id`='$brand' )");
        $bn = $b->num_rows;
        for ($x = 0; $x < $bn; $x++) {
            $bd = $b->fetch_assoc();
            echo $bd["title"];
        }
    } else if (!empty($keyword) && $model != "0") {
        $m = database::search("SELECT * FROM `product` WHERE `title` LIKE '%" . $keyword . "%' AND `model_has_brand_id` IN(SELECT `id` FROM `model_has_brand` WHERE `model_id`='$model' )");
    }
} else {
    echo "You must enter a keyword to search";
}
