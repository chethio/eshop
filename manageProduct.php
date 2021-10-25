<?php
require "connection.php";
$page_no;

if (isset($_GET["page"])) {
    $page_no = $_GET["page"];
} else {

    $page_no = 1;
}



$number_of_pages = 2;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>eShop | Manage Users </title>
    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="stylesheet" href="style.css" />
    <link rel="stylesheet" href="addproduct.css" />
    <link rel="icon" href="resources/logo.svg" />

    <script src="jquery.min.js"></script>
</head>

<body style="background-color: #74EBD5; background-image: linear-gradient(90deg,#74EBD5 0%,#9FACE6 100%);">

    <div class="container-fluid">
        <div class="row">

            <div class="col-12 bg-light text-center rounded ">
                <label for="" class="form-label fs-2 fw-bold text-primary">Manage All Products</label>
            </div>

            <div class="col-12 mt-3 mb-2">
                <div class="row">

                    <div class="col-2 col-lg-1 bg-primary pt-2 pb-2 text-end">
                        <span class="fs-4 fw-bold text-white">#</span>
                    </div>

                    <div class="col-2 col-lg-2 bg-light pt-2 pb-2 d-none d-lg-block">
                        <span class="fs-4 fw-bold">Product Image</span>
                    </div>

                    <div class="col-2 bg-primary pt-2 pb-2 ">
                        <span class="fs-4 fw-bold text-white">Title</span>
                    </div>

                    <div class="col-6 col-lg-2 bg-light pt-2 pb-2">
                        <span class="fs-4 fw-bold">Price</span>
                    </div>



                    <div class="col-2 bg-primary pt-2 pb-2 d-none d-lg-block">
                        <span class="fs-4 fw-bold text-white">Seller</span>
                    </div>

                    <div class="col-3 bg-light pt-2 pb-2 d-none d-lg-block">
                        <span class="fs-4 fw-bold">Description</span>
                    </div>


                </div>
            </div>


            <div class="col-12 mb-2">
                <div class="row" id="manageproductload">



                </div>
            </div>



            <hr />

            <div class="col-12">
                <h3 class="text-primary">Manage Categories</h3>
            </div>

            <hr>



            <div class="col-12 mb-3">
                <div class="row g-1">

                    <?php
                    $categoryrs = database::search("SELECT * FROM `category`");
                    $num = $categoryrs->num_rows;

                    for ($i = 0; $i < $num; $i++) {
                        $row = $categoryrs->fetch_assoc();
                    ?>

                    <div class="col-12 col-lg-3">
                        <div class="row g-1 px-1">
                            <div class="col-12 text-center bg-body border border-2 border-success shadow rounded">
                                <label class="form-label fs-4 fw-bold py-3"><?php echo $row["name"]; ?></label>
                            </div>
                        </div>
                    </div>

                    <?php
                    }
                    ?>



                    <div class="col-12 col-lg-3">
                        <div class="row g-1 px-1">
                            <div class="col-12 text-center bg-body border border-2 border-danger shadow rounded">
                                <div class="row">
                                    <div class="col-3 mt-3 addnewimg"></div>
                                    <div class="col-9">
                                        <label onclick="addnewmodal();"
                                            class="form-label fs-4 fw-bold py-3 text-black-50">Add New
                                            Category</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <!-- modal -->

            <!-- Category Modal -->
            <div class="modal fade" id="catmodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Add New Category</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <label class="form-label">Category</label>
                            <input type="text" class="form-control" id="categorytext">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button onclick="savecategory();" type="button" class="btn btn-primary">Save
                                Category</button>
                        </div>
                    </div>
                </div>
            </div>

            <!--Category modal -->


            <!-- single view product -->

            <div class="modal fade" id="singleproductview" tabindex="-1" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Iphone 12</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">

                            <div class="text-center">
                                <img style="height: 300px;" class="rounded rounded-5"
                                    src="resources/products6155574b6ea78huawei_p20.png">
                            </div>
                            <span class="fs-5 fw-bold">Price</span>
                            <span>Rs.12000</span>
                            <br>
                            <span class="fs-5 fw-bold">Quantity</span>
                            <span>10 Items Left</span>
                            <br>
                            <span class="fs-5 fw-bold">Seller</span>
                            <span>Chethan Rocks</span>
                            <br>
                            <span class="fs-5 fw-bold">Description</span>
                            <p>Great</p>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button onclick="savecategory();" type="button" class="btn btn-primary">Save
                                Category</button>
                        </div>
                    </div>
                </div>
            </div>


            <!-- single view product -->

            <?php require "footer.php" ?>
        </div>
    </div>

    <script src="script.js"></script>
    <script src="bootstrap.js"></script>
    <script src="bootstrap.bundle.js"></script>
</body>

</html>