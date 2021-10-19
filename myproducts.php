<?php
session_start();
if (isset($_SESSION["u"])) {
    $u = $_SESSION["u"];
    require "connection.php";
    $page_no;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eshop|My Products</title>
    <link rel="icon" href="resources/logo.svg">
    <!-- <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css"> -->
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="bootstrap.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
</head>

<body style="background-color: #E9EBEE;">

    <div class="container-fluid">
        <div class="row">
            <!-- head -->
            <div class="col-12 bg-primary">

                <div class="row">
                    <div class="col-lg-1 col-5 mt-1 mb-1">
                        <?php


                            $profile = database::search("SELECT * FROM profile_img WHERE `user_email`='" . $u["email"] . "';");
                            $pn = $profile->num_rows;

                            if ($pn == 1) {
                                $pr = $profile->fetch_assoc();
                            ?>
                        <img src="<?php echo $pr["code"]; ?>" class="rounded-circle" height="70px">
                        <?php
                            } else {
                            ?>
                        <img src="resources/Profile.jpg" class="rounded-circle" height="90px" width="90px">
                        <?php
                            }
                            ?>

                    </div>

                    <div class="col-lg-3 col-7">
                        <div class="row">
                            <div class="col-12 mt-4">

                                <b><span class="fw-bold"><?php echo $u["fname"] . " " . $u["lname"]; ?></span></b>
                            </div>

                            <div class="col-12">
                                <b><span class="fw-bold text-light"><?php echo $u["email"]; ?></span></b>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-8 col-12 mt-3 mb-2 mb-lg-0">
                        <h1 class=" text-white fw-bold offset-lg-2 offset-3">My Products</h1>
                    </div>
                </div>
            </div>

            <!-- head end -->
            <div class="col-12">
                <div class="row">
                    <!-- filter section -->
                    <div class="col-12 col-lg-2 mt-3 mb-3 rounded bg-body border border-primary">
                        <div class="row">
                            <div class="col-12 mt-3 ms-3 fs-5">
                                <div class="row">
                                    <div class="col-12">
                                        <label class="form-label fw-bold fs-1">Filters</label>
                                    </div>
                                    <div class="col-11">
                                        <div class="row">
                                            <div class="col-10">
                                                <input id="s" type="text" placeholder="Search" class="form-control">
                                            </div>
                                            <div class="col-1">
                                                <label onclick="addfilters();"
                                                    class="form-label fs-4 bi bi-search"></label>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- time added -->
                                    <div class="col-12 mt-3">
                                        <label class="form-label fw-bold">Active time</label>
                                    </div>
                                    <div class="col-12">
                                        <hr width="80%">
                                    </div>
                                    <div class="col-12">
                                        <div class="form-check">
                                            <input class="form-check-input fs-6" type="radio" name="flexRadioDefault"
                                                id="n">
                                            <label class="form-check-label fs-6" for="flexRadioDefault1">
                                                Newer to oldest
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input fs-6" type="radio" name="flexRadioDefault"
                                                id="o">
                                            <label class="form-check-label fs-6" for="flexRadioDefault2">
                                                Oldest to newer
                                            </label>
                                        </div>
                                    </div>

                                    <!-- quantity -->
                                    <div class="col-12 mt-3">
                                        <label class="form-label fw-bold">By Quantity</label>
                                    </div>
                                    <div class="col-12">
                                        <hr width="80%">
                                    </div>
                                    <div class="col-12">
                                        <div class="form-check">
                                            <input class="form-check-input fs-6" type="radio" name="flexRadioDefault2"
                                                id="l">
                                            <label class="form-check-label fs-6" for="flexRadioDefault1">
                                                Low to High
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input fs-6" type="radio" name="flexRadioDefault2"
                                                id="h">
                                            <label class="form-check-label fs-6" for="flexRadioDefault2">
                                                High to Low
                                            </label>
                                        </div>
                                    </div>

                                    <!-- condition -->
                                    <div class="col-12 mt-3">
                                        <label class="form-label fw-bold">By Condition</label>
                                    </div>
                                    <div class="col-12">
                                        <hr width="80%">
                                    </div>
                                    <div class="col-12">
                                        <div class="form-check">
                                            <input class="form-check-input fs-6" type="radio" name="flexRadioDefault3"
                                                id="b">
                                            <label class="form-check-label fs-6" for="flexRadioDefault1">
                                                Brand New
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input fs-6" type="radio" name="flexRadioDefault3"
                                                id="u">
                                            <label class="form-check-label fs-6" for="flexRadioDefault2">
                                                Used
                                            </label>
                                        </div>
                                    </div>
                                    <!-- clear all filters -->
                                    <div class="col-10 col-lg-8 offset-1 offset-lg-2 mb-3 mt-3 d-grid ">
                                        <a href="myproducts.php" class="d-grid btn btn-primary me-2">Clear filters</a>
                                        <button class="btn btn-success me-2 mt-2"
                                            onclick="addfilters();">Search</button>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>


                    <!-- filter section end -->

                    <!-- product -->

                    <div class="col-12 col-lg-10 mt-3 mb-3 bg-light border border-primary">
                        <div class="row" id="div1">



                            <?php
                                if (isset($_GET["page"])) {
                                    $page_no = $_GET["page"];
                                } else {

                                    $page_no = 1;
                                }
                                $products = database::search("SELECT * FROM product WHERE `user_email`='" . $u["email"] . "'");
                                $np = $products->num_rows;
                                $dp = $products->fetch_assoc();

                                $result_per_page = 6;
                                $number_of_pages = ceil($np / $result_per_page);   // ceil rounds up decimal numbers to whole numbers

                                // echo $np;
                                //echo $number_of_pages;


                                $firstpage_result = ((int) $page_no - 1) * $result_per_page;
                                $selectdrs = database::search("SELECT * FROM `product` WHERE `user_email`='" . $u["email"] . "' LIMIT " . $result_per_page . " OFFSET " . $firstpage_result . " ");
                                $snr = $selectdrs->num_rows;
                                // for ($x = 0; $x < $snr; $x++) {
                                //     $srow = $selectdrs->fetch_assoc();

                                while ($srow = $selectdrs->fetch_assoc()) {


                                ?>

                            <div class="card mb-3 col-12 col-lg-5 mt-3 ms-lg-4 ms-0">
                                <div class="row g-0">
                                    <div class="col-md-4 mt-3">
                                        <?php
                                                $pimgs = database::search("SELECT * FROM image WHERE `product_id`='" . $srow["id"] . "'");
                                                $pir = $pimgs->fetch_assoc();
                                                ?>
                                        <img src="<?php echo $pir["code"]; ?>" class="img-fluid rounded-start"
                                            alt="...">
                                    </div>
                                    <div class="col-md-8">
                                        <div class="card-body">
                                            <h5 class="card-title fw-bold"><?php echo $srow["title"]; ?></h5>
                                            <span
                                                class="card-text text-primary fw-bold">Rs.<?php echo $srow["price"]; ?></span>
                                            <br>
                                            <span
                                                class="card-text text-success fw-bold"><?php echo $srow["qty"]; ?>&nbsp;
                                                Items
                                                Left</span>
                                            <br>
                                            <div class="form-check form-switch mb-2">

                                                <input class="form-check-input" type="checkbox" id="check"
                                                    onchange="changestatus(<?php echo $srow['id']; ?>);"
                                                    <?php if ($srow["status_id"] == 2) {
                                                                                                                                                                            echo "checked";
                                                                                                                                                                        } ?> />
                                                <label class="form-check-label text-info fw-bold" for="check"
                                                    id="checklabel<?php echo $srow['id']; ?>"><?php if ($srow["status_id"] == 2) {
                                                                                                                                                                    echo "Activate Product";
                                                                                                                                                                } else {
                                                                                                                                                                    echo "Deactivate Product";
                                                                                                                                                                } ?></label>
                                            </div>
                                            <dic class="col-12">
                                                <div class="row">
                                                    <div class="col-lg-6 col-12">
                                                        <a onclick="send_id(<?php echo $srow['id']; ?>);"
                                                            class="btn btn-success d-grid" href="#">Update</a>
                                                    </div>

                                                    <div class="col-lg-6 col-12 mt-1 mt-lg-0">
                                                        <a class="btn btn-danger d-grid" href="#"
                                                            onclick="deletemodal(<?php echo $srow['id']; ?>);">Delete
                                                        </a>
                                                    </div>
                                                </div>
                                            </dic>


                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- modal -->
                            <div class="modal fade" id="deletemodal<?php echo $srow['id']; ?>" tabindex="-1"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title  fw-bolder text-warning" id="exampleModalLabel">
                                                Warning!</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            Are You Sure You want To Delete This Product?
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Cancel</button>
                                            <button type="button" class="btn btn-danger"
                                                onclick="deleteproduct(<?php echo $srow['id']; ?>);">Delete</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- modal end -->
                            <?php
                                }
                                ?>

                            <!-- <div class="offset-1 col-10 text-center">
                                <div class="row">





                                    <div class="card mb-3 col-12 col-lg-5 mt-3 ms-lg-4 ms-0">
                                        <div class="row g-0">
                                            <div class="col-md-4 mt-3">
                                                <img src="resources/products/6155562384488.png"
                                                    class="img-fluid rounded-start" alt="...">
                                            </div>
                                            <div class="col-md-8">
                                                <div class="card-body">
                                                    <h5 class="card-title fw-bold">OPPO A95</h5>
                                                    <span class="card-text text-primary fw-bold">Rs.15000.00</span>
                                                    <br>
                                                    <span class="card-text text-success fw-bold">10 Items Left</span>
                                                    <br>
                                                    <div class="form-check form-switch mb-2">
                                                        <input class="form-check-input" type="checkbox"
                                                            id="flexSwitchCheckDefault">
                                                        <label class="form-check-label text-info fw-bold"
                                                            for="flexSwitchCheckDefault">Deactivate your product
                                                            here</label>
                                                    </div>
                                                    <dic class="col-12">
                                                        <div class="row">
                                                            <div class="col-lg-6 col-12">
                                                                <a class="btn btn-success d-grid" href="">Update
                                                                </a>
                                                            </div>

                                                            <div class="col-lg-6 col-12 mt-1 mt-lg-0">
                                                                <a class="btn btn-danger d-grid" href="">Delete
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </dic>
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                </div>
                            </div> -->

                        </div>

                        <!-- pagination -->
                        <div class="col-12 ">
                            <div class="offset-4 mb-3 col-4 d-flex justify-content-center">
                                <div id="pagination" class="pagination justify-content-center">
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
                                    <a class="ms-1 active"
                                        href="<?php echo "?page=" . ($page); ?>"><?php echo $page; ?></a>
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


                        <!-- pagination end -->
                    </div>

                </div>

                <!-- product end -->
            </div>

        </div>



    </div>
    <?php
        require "footer.php";
        ?>
    </div>


    <script src="script.js"></script>
    <script src="bootstrap.js"></script>
</body>

</html>




<!-- session management -->
<?php
} else {
?>

<script>
alert("Sign in first!");
window.location = "index.php";
</script>
<?php
}
?>