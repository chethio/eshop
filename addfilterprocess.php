<?php
session_start();
$u = $_SESSION["u"];
require "connection.php";

$array = [];

$search = $_POST["se"];
$age = $_POST["a"];
$qty = $_POST["q"];
$condition = $_POST["c"];


if (!empty($search) && $age != 0) {
    if ($age == 1) {
        $prs = database::search("SELECT * FROM product WHERE `user_email`='" . $u["email"] . "'  AND  `title` LIKE '%" . $search . "%' ORDER BY `datetime_added` DESC;");
        $saq = $prs->num_rows;

        for ($i = 0; $i < $saq; $i++) {
            $page = $prs->fetch_assoc();


?>

<div class="col-6 g-5">
    <div class="card mb-3 mt-3 ms-0">
        <div class="row mx-2">

            <div class="col-md-4 mt-3">
                <?php
                            $pimgs = database::search("SELECT * FROM image WHERE `product_id`='" . $page["id"] . "'");
                            $pir = $pimgs->fetch_assoc();
                            ?>
                <img src="<?php echo $pir["code"]; ?>" class="img-fluid rounded-start" alt="...">
            </div>
            <div class="col-md-8">
                <div class="card-body">
                    <h5 class="card-title fw-bold"><?php echo $page["title"]; ?></h5>
                    <span class="card-text text-primary fw-bold">Rs.<?php echo $page["price"]; ?></span>
                    <br>
                    <span class="card-text text-success fw-bold"><?php echo $page["qty"]; ?>&nbsp;
                        Items
                        Left</span>
                    <br>
                    <div class="form-check form-switch mb-2">

                        <input class="form-check-input" type="checkbox" id="check"
                            onchange="changestatus(<?php echo $page['id']; ?>);"
                            <?php if ($page["status_id"] == 2) {
                                                                                                                                                        echo "checked";
                                                                                                                                                    } ?> />
                        <label class="form-check-label text-info fw-bold" for="check"
                            id="checklabel<?php echo $page['id']; ?>"><?php if ($page["status_id"] == 2) {
                                                                                                                                                echo "Activate Product";
                                                                                                                                            } else {
                                                                                                                                                echo "Deactivate Product";
                                                                                                                                            } ?></label>
                    </div>
                    <dic class="col-12">
                        <div class="row">
                            <div class="col-lg-6 col-12">
                                <a onclick="send_id(<?php echo $page['id']; ?>);" class="btn btn-success d-grid"
                                    href="#">Update</a>
                            </div>

                            <div class="col-lg-6 col-12 mt-1 mt-lg-0">
                                <a class="btn btn-danger d-grid" href="#"
                                    onclick="deletemodal(<?php echo $page['id']; ?>);">Delete
                                </a>
                            </div>
                        </div>
                    </dic>


                </div>
            </div>

        </div>
    </div>
</div>



<?php
        }
    } else if ($age == 2) {

        $prs = database::search("SELECT * FROM product WHERE `user_email`='" . $u["email"] . "'  AND  `title` LIKE '%" . $search . "%' ORDER BY `datetime_added` ASC;");
        $saq = $prs->num_rows;

        for ($i = 0; $i < $saq; $i++) {
            $page = $prs->fetch_assoc();


        ?>

<div class="col-6 g-5">
    <div class="card mb-3 mt-3 ms-0">
        <div class="row mx-2">

            <div class="col-md-4 mt-3">
                <?php
                            $pimgs = database::search("SELECT * FROM image WHERE `product_id`='" . $page["id"] . "'");
                            $pir = $pimgs->fetch_assoc();
                            ?>
                <img src="<?php echo $pir["code"]; ?>" class="img-fluid rounded-start" alt="...">
            </div>
            <div class="col-md-8">
                <div class="card-body">
                    <h5 class="card-title fw-bold"><?php echo $page["title"]; ?></h5>
                    <span class="card-text text-primary fw-bold">Rs.<?php echo $page["price"]; ?></span>
                    <br>
                    <span class="card-text text-success fw-bold"><?php echo $page["qty"]; ?>&nbsp;
                        Items
                        Left</span>
                    <br>
                    <div class="form-check form-switch mb-2">

                        <input class="form-check-input" type="checkbox" id="check"
                            onchange="changestatus(<?php echo $page['id']; ?>);"
                            <?php if ($page["status_id"] == 2) {
                                                                                                                                                        echo "checked";
                                                                                                                                                    } ?> />
                        <label class="form-check-label text-info fw-bold" for="check"
                            id="checklabel<?php echo $page['id']; ?>"><?php if ($page["status_id"] == 2) {
                                                                                                                                                echo "Activate Product";
                                                                                                                                            } else {
                                                                                                                                                echo "Deactivate Product";
                                                                                                                                            } ?></label>
                    </div>
                    <dic class="col-12">
                        <div class="row">
                            <div class="col-lg-6 col-12">
                                <a onclick="send_id(<?php echo $page['id']; ?>);" class="btn btn-success d-grid"
                                    href="#">Update</a>
                            </div>

                            <div class="col-lg-6 col-12 mt-1 mt-lg-0">
                                <a class="btn btn-danger d-grid" href="#"
                                    onclick="deletemodal(<?php echo $page['id']; ?>);">Delete
                                </a>
                            </div>
                        </div>
                    </dic>


                </div>
            </div>

        </div>
    </div>
</div>



<?php
        }
    }
} else if (!empty($search) && $qty != 0) {
    if ($qty == 1) {
        $prs = database::search("SELECT * FROM product WHERE `user_email`='" . $u["email"] . "'  AND  `title` LIKE '%" . $search . "%' ORDER BY `qty` ASC;");
        $saq = $prs->num_rows;

        for ($i = 0; $i < $saq; $i++) {
            $page = $prs->fetch_assoc();


        ?>

<div class="col-6 g-5">
    <div class="card mb-3 mt-3 ms-0">
        <div class="row mx-2">

            <div class="col-md-4 mt-3">
                <?php
                            $pimgs = database::search("SELECT * FROM image WHERE `product_id`='" . $page["id"] . "'");
                            $pir = $pimgs->fetch_assoc();
                            ?>
                <img src="<?php echo $pir["code"]; ?>" class="img-fluid rounded-start" alt="...">
            </div>
            <div class="col-md-8">
                <div class="card-body">
                    <h5 class="card-title fw-bold"><?php echo $page["title"]; ?></h5>
                    <span class="card-text text-primary fw-bold">Rs.<?php echo $page["price"]; ?></span>
                    <br>
                    <span class="card-text text-success fw-bold"><?php echo $page["qty"]; ?>&nbsp;
                        Items
                        Left</span>
                    <br>
                    <div class="form-check form-switch mb-2">

                        <input class="form-check-input" type="checkbox" id="check"
                            onchange="changestatus(<?php echo $page['id']; ?>);"
                            <?php if ($page["status_id"] == 2) {
                                                                                                                                                        echo "checked";
                                                                                                                                                    } ?> />
                        <label class="form-check-label text-info fw-bold" for="check"
                            id="checklabel<?php echo $page['id']; ?>"><?php if ($page["status_id"] == 2) {
                                                                                                                                                echo "Activate Product";
                                                                                                                                            } else {
                                                                                                                                                echo "Deactivate Product";
                                                                                                                                            } ?></label>
                    </div>
                    <dic class="col-12">
                        <div class="row">
                            <div class="col-lg-6 col-12">
                                <a onclick="send_id(<?php echo $page['id']; ?>);" class="btn btn-success d-grid"
                                    href="#">Update</a>
                            </div>

                            <div class="col-lg-6 col-12 mt-1 mt-lg-0">
                                <a class="btn btn-danger d-grid" href="#"
                                    onclick="deletemodal(<?php echo $page['id']; ?>);">Delete
                                </a>
                            </div>
                        </div>
                    </dic>


                </div>
            </div>

        </div>
    </div>
</div>


<?php
        }
    } else if ($qty == 2) {

        $prs = database::search("SELECT * FROM product WHERE `user_email`='" . $u["email"] . "'  AND  `title` LIKE '%" . $search . "%' ORDER BY `qty` DESC;");
        $saq = $prs->num_rows;

        for ($i = 0; $i < $saq; $i++) {
            $page = $prs->fetch_assoc();


        ?>

<div class="col-6 g-5">
    <div class="card mb-3 mt-3 ms-0">
        <div class="row mx-2">

            <div class="col-md-4 mt-3">
                <?php
                            $pimgs = database::search("SELECT * FROM image WHERE `product_id`='" . $page["id"] . "'");
                            $pir = $pimgs->fetch_assoc();
                            ?>
                <img src="<?php echo $pir["code"]; ?>" class="img-fluid rounded-start" alt="...">
            </div>
            <div class="col-md-8">
                <div class="card-body">
                    <h5 class="card-title fw-bold"><?php echo $page["title"]; ?></h5>
                    <span class="card-text text-primary fw-bold">Rs.<?php echo $page["price"]; ?></span>
                    <br>
                    <span class="card-text text-success fw-bold"><?php echo $page["qty"]; ?>&nbsp;
                        Items
                        Left</span>
                    <br>
                    <div class="form-check form-switch mb-2">

                        <input class="form-check-input" type="checkbox" id="check"
                            onchange="changestatus(<?php echo $page['id']; ?>);"
                            <?php if ($page["status_id"] == 2) {
                                                                                                                                                        echo "checked";
                                                                                                                                                    } ?> />
                        <label class="form-check-label text-info fw-bold" for="check"
                            id="checklabel<?php echo $page['id']; ?>"><?php if ($page["status_id"] == 2) {
                                                                                                                                                echo "Activate Product";
                                                                                                                                            } else {
                                                                                                                                                echo "Deactivate Product";
                                                                                                                                            } ?></label>
                    </div>
                    <dic class="col-12">
                        <div class="row">
                            <div class="col-lg-6 col-12">
                                <a onclick="send_id(<?php echo $page['id']; ?>);" class="btn btn-success d-grid"
                                    href="#">Update</a>
                            </div>

                            <div class="col-lg-6 col-12 mt-1 mt-lg-0">
                                <a class="btn btn-danger d-grid" href="#"
                                    onclick="deletemodal(<?php echo $page['id']; ?>);">Delete
                                </a>
                            </div>
                        </div>
                    </dic>


                </div>
            </div>

        </div>
    </div>
</div>



<?php

        }
    }

    // search and condition
} else if (!empty($search) && $condition != 0) {
    if ($condition == 1) {
        $prs = database::search("SELECT * FROM product WHERE `user_email`='" . $u["email"] . "'  AND  `title` LIKE '%" . $search . "%' AND `condition_id`='1';");
        $saq = $prs->num_rows;

        for ($i = 0; $i < $saq; $i++) {
            $page = $prs->fetch_assoc();


        ?>

<div class="col-6 g-5">
    <div class="card mb-3 mt-3 ms-0">
        <div class="row mx-2">

            <div class="col-md-4 mt-3">
                <?php
                            $pimgs = database::search("SELECT * FROM image WHERE `product_id`='" . $page["id"] . "'");
                            $pir = $pimgs->fetch_assoc();
                            ?>
                <img src="<?php echo $pir["code"]; ?>" class="img-fluid rounded-start" alt="...">
            </div>
            <div class="col-md-8">
                <div class="card-body">
                    <h5 class="card-title fw-bold"><?php echo $page["title"]; ?></h5>
                    <span class="card-text text-primary fw-bold">Rs.<?php echo $page["price"]; ?></span>
                    <br>
                    <span class="card-text text-success fw-bold"><?php echo $page["qty"]; ?>&nbsp;
                        Items
                        Left</span>
                    <br>
                    <div class="form-check form-switch mb-2">

                        <input class="form-check-input" type="checkbox" id="check"
                            onchange="changestatus(<?php echo $page['id']; ?>);"
                            <?php if ($page["status_id"] == 2) {
                                                                                                                                                        echo "checked";
                                                                                                                                                    } ?> />
                        <label class="form-check-label text-info fw-bold" for="check"
                            id="checklabel<?php echo $page['id']; ?>"><?php if ($page["status_id"] == 2) {
                                                                                                                                                echo "Activate Product";
                                                                                                                                            } else {
                                                                                                                                                echo "Deactivate Product";
                                                                                                                                            } ?></label>
                    </div>
                    <dic class="col-12">
                        <div class="row">
                            <div class="col-lg-6 col-12">
                                <a onclick="send_id(<?php echo $page['id']; ?>);" class="btn btn-success d-grid"
                                    href="#">Update</a>
                            </div>

                            <div class="col-lg-6 col-12 mt-1 mt-lg-0">
                                <a class="btn btn-danger d-grid" href="#"
                                    onclick="deletemodal(<?php echo $page['id']; ?>);">Delete
                                </a>
                            </div>
                        </div>
                    </dic>


                </div>
            </div>

        </div>
    </div>
</div>



<?php
        }
    } else if ($condition == 2) {

        $prs = database::search("SELECT * FROM product WHERE `user_email`='" . $u["email"] . "'  AND  `title` LIKE '%" . $search . "%' AND `condition_id`='2';");
        $saq = $prs->num_rows;

        for ($i = 0; $i < $saq; $i++) {
            $page = $prs->fetch_assoc();


        ?>

<div class="col-6 g-5">
    <div class="card mb-3 mt-3 ms-0">
        <div class="row mx-2">

            <div class="col-md-4 mt-3">
                <?php
                            $pimgs = database::search("SELECT * FROM image WHERE `product_id`='" . $page["id"] . "'");
                            $pir = $pimgs->fetch_assoc();
                            ?>
                <img height="200px" src="<?php echo $pir["code"]; ?>" class="img-fluid rounded-start" alt="...">
            </div>
            <div class="col-md-8">
                <div class="card-body">
                    <h5 class="card-title fw-bold"><?php echo $page["title"]; ?></h5>
                    <span class="card-text text-primary fw-bold">Rs.<?php echo $page["price"]; ?></span>
                    <br>
                    <span class="card-text text-success fw-bold"><?php echo $page["qty"]; ?>&nbsp;
                        Items
                        Left</span>
                    <br>
                    <div class="form-check form-switch mb-2">

                        <input class="form-check-input" type="checkbox" id="check"
                            onchange="changestatus(<?php echo $page['id']; ?>);"
                            <?php if ($page["status_id"] == 2) {
                                                                                                                                                        echo "checked";
                                                                                                                                                    } ?> />
                        <label class="form-check-label text-info fw-bold" for="check"
                            id="checklabel<?php echo $page['id']; ?>"><?php if ($page["status_id"] == 2) {
                                                                                                                                                echo "Activate Product";
                                                                                                                                            } else {
                                                                                                                                                echo "Deactivate Product";
                                                                                                                                            } ?></label>
                    </div>
                    <dic class="col-12">
                        <div class="row">
                            <div class="col-lg-6 col-12">
                                <a onclick="send_id(<?php echo $page['id']; ?>);" class="btn btn-success d-grid"
                                    href="#">Update</a>
                            </div>

                            <div class="col-lg-6 col-12 mt-1 mt-lg-0">
                                <a class="btn btn-danger d-grid" href="#"
                                    onclick="deletemodal(<?php echo $page['id']; ?>);">Delete
                                </a>
                            </div>
                        </div>
                    </dic>


                </div>
            </div>

        </div>
    </div>
</div>



<?php

        }
    }
} else if (!empty($search)) {
    $products = database::search("SELECT * FROM product WHERE `user_email`='" . $u["email"] . "'  AND  `title` LIKE '%" . $search . "%'");
    $pn = $products->num_rows;
    for ($i = 0; $i < $pn; $i++) {
        $page = $products->fetch_assoc();

        $page_no;

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

<div class="col-6 g-5">
    <div class="card mb-3 mt-3 ms-0">
        <div class="row mx-2">

            <div class="col-md-4 mt-3">
                <?php
                            $pimgs = database::search("SELECT * FROM image WHERE `product_id`='" . $page["id"] . "'");
                            $pir = $pimgs->fetch_assoc();
                            ?>
                <img src="<?php echo $pir["code"]; ?>" class="img-fluid rounded-start" alt="...">
            </div>
            <div class="col-md-8">
                <div class="card-body">
                    <h5 class="card-title fw-bold"><?php echo $page["title"]; ?></h5>
                    <span class="card-text text-primary fw-bold">Rs.<?php echo $page["price"]; ?></span>
                    <br>
                    <span class="card-text text-success fw-bold"><?php echo $page["qty"]; ?>&nbsp;
                        Items
                        Left</span>
                    <br>
                    <div class="form-check form-switch mb-2">

                        <input class="form-check-input" type="checkbox" id="check"
                            onchange="changestatus(<?php echo $page['id']; ?>);"
                            <?php if ($page["status_id"] == 2) {
                                                                                                                                                        echo "checked";
                                                                                                                                                    } ?> />
                        <label class="form-check-label text-info fw-bold" for="check"
                            id="checklabel<?php echo $page['id']; ?>"><?php if ($page["status_id"] == 2) {
                                                                                                                                                echo "Activate Product";
                                                                                                                                            } else {
                                                                                                                                                echo "Deactivate Product";
                                                                                                                                            } ?></label>
                    </div>
                    <dic class="col-12">
                        <div class="row">
                            <div class="col-lg-6 col-12">
                                <a onclick="send_id(<?php echo $page['id']; ?>);" class="btn btn-success d-grid"
                                    href="#">Update</a>
                            </div>

                            <div class="col-lg-6 col-12 mt-1 mt-lg-0">
                                <a class="btn btn-danger d-grid" href="#"
                                    onclick="deletemodal(<?php echo $page['id']; ?>);">Delete
                                </a>
                            </div>
                        </div>
                    </dic>


                </div>
            </div>

        </div>
    </div>
</div>

<?php
        }
        ?>
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


<!-- pagination end -->

<?php
    }
} else if (!empty($age)) {
    if ($age == 1) {
        $prs = database::search("SELECT * FROM product WHERE `user_email`='" . $u["email"] . "' ORDER BY `datetime_added` DESC");
        $an = $prs->num_rows;

        for ($i = 0; $i < $an; $i++) {
            $page = $prs->fetch_assoc();


        ?>

<div class="col-6 g-5">
    <div class="card mb-3 mt-3 ms-0">
        <div class="row mx-2">

            <div class="col-md-4 mt-3">
                <?php
                            $pimgs = database::search("SELECT * FROM image WHERE `product_id`='" . $page["id"] . "'");
                            $pir = $pimgs->fetch_assoc();
                            ?>
                <img src="<?php echo $pir["code"]; ?>" class="img-fluid rounded-start" alt="...">
            </div>
            <div class="col-md-8">
                <div class="card-body">
                    <h5 class="card-title fw-bold"><?php echo $page["title"]; ?></h5>
                    <span class="card-text text-primary fw-bold">Rs.<?php echo $page["price"]; ?></span>
                    <br>
                    <span class="card-text text-success fw-bold"><?php echo $page["qty"]; ?>&nbsp;
                        Items
                        Left</span>
                    <br>
                    <div class="form-check form-switch mb-2">

                        <input class="form-check-input" type="checkbox" id="check"
                            onchange="changestatus(<?php echo $page['id']; ?>);"
                            <?php if ($page["status_id"] == 2) {
                                                                                                                                                        echo "checked";
                                                                                                                                                    } ?> />
                        <label class="form-check-label text-info fw-bold" for="check"
                            id="checklabel<?php echo $page['id']; ?>"><?php if ($page["status_id"] == 2) {
                                                                                                                                                echo "Activate Product";
                                                                                                                                            } else {
                                                                                                                                                echo "Deactivate Product";
                                                                                                                                            } ?></label>
                    </div>
                    <dic class="col-12">
                        <div class="row">
                            <div class="col-lg-6 col-12">
                                <a onclick="send_id(<?php echo $page['id']; ?>);" class="btn btn-success d-grid"
                                    href="#">Update</a>
                            </div>

                            <div class="col-lg-6 col-12 mt-1 mt-lg-0">
                                <a class="btn btn-danger d-grid" href="#"
                                    onclick="deletemodal(<?php echo $page['id']; ?>);">Delete
                                </a>
                            </div>
                        </div>
                    </dic>


                </div>
            </div>

        </div>
    </div>
</div>


<?php
        }
    } else if ($age == 2) {
        $prs = database::search("SELECT * FROM product WHERE `user_email`='" . $u["email"] . "' ORDER BY `datetime_added` ASC");
        $an = $prs->num_rows;

        for ($i = 0; $i < $an; $i++) {
            $page = $prs->fetch_assoc();



        ?>

<div class="col-6 g-5">
    <div class="card mb-3 mt-3 ms-0">
        <div class="row mx-2">

            <div class="col-md-4 mt-3">
                <?php
                            $pimgs = database::search("SELECT * FROM image WHERE `product_id`='" . $page["id"] . "'");
                            $pir = $pimgs->fetch_assoc();
                            ?>
                <img src="<?php echo $pir["code"]; ?>" class="img-fluid rounded-start" alt="...">
            </div>
            <div class="col-md-8">
                <div class="card-body">
                    <h5 class="card-title fw-bold"><?php echo $page["title"]; ?></h5>
                    <span class="card-text text-primary fw-bold">Rs.<?php echo $page["price"]; ?></span>
                    <br>
                    <span class="card-text text-success fw-bold"><?php echo $page["qty"]; ?>&nbsp;
                        Items
                        Left</span>
                    <br>
                    <div class="form-check form-switch mb-2">

                        <input class="form-check-input" type="checkbox" id="check"
                            onchange="changestatus(<?php echo $page['id']; ?>);"
                            <?php if ($page["status_id"] == 2) {
                                                                                                                                                        echo "checked";
                                                                                                                                                    } ?> />
                        <label class="form-check-label text-info fw-bold" for="check"
                            id="checklabel<?php echo $page['id']; ?>"><?php if ($page["status_id"] == 2) {
                                                                                                                                                echo "Activate Product";
                                                                                                                                            } else {
                                                                                                                                                echo "Deactivate Product";
                                                                                                                                            } ?></label>
                    </div>
                    <dic class="col-12">
                        <div class="row">
                            <div class="col-lg-6 col-12">
                                <a onclick="send_id(<?php echo $page['id']; ?>);" class="btn btn-success d-grid"
                                    href="#">Update</a>
                            </div>

                            <div class="col-lg-6 col-12 mt-1 mt-lg-0">
                                <a class="btn btn-danger d-grid" href="#"
                                    onclick="deletemodal(<?php echo $page['id']; ?>);">Delete
                                </a>
                            </div>
                        </div>
                    </dic>


                </div>
            </div>

        </div>
    </div>
</div>



<?php
        }
    }
} else if ($qty !== 0) {
    if ($qty == 1) {
        $prs = database::search("SELECT * FROM product WHERE `user_email`='" . $u["email"] . "' ORDER BY `qty` ASC");
        $qan = $prs->num_rows;

        for ($i = 0; $i < $qan; $i++) {
            $page = $prs->fetch_assoc();


        ?>

<div class="col-6 g-5">
    <div class="card mb-3 mt-3 ms-0">
        <div class="row mx-2">

            <div class="col-md-4 mt-3">
                <?php
                            $pimgs = database::search("SELECT * FROM image WHERE `product_id`='" . $page["id"] . "'");
                            $pir = $pimgs->fetch_assoc();
                            ?>
                <img src="<?php echo $pir["code"]; ?>" class="img-fluid rounded-start" alt="...">
            </div>
            <div class="col-md-8">
                <div class="card-body">
                    <h5 class="card-title fw-bold"><?php echo $page["title"]; ?></h5>
                    <span class="card-text text-primary fw-bold">Rs.<?php echo $page["price"]; ?></span>
                    <br>
                    <span class="card-text text-success fw-bold"><?php echo $page["qty"]; ?>&nbsp;
                        Items
                        Left</span>
                    <br>
                    <div class="form-check form-switch mb-2">

                        <input class="form-check-input" type="checkbox" id="check"
                            onchange="changestatus(<?php echo $page['id']; ?>);"
                            <?php if ($page["status_id"] == 2) {
                                                                                                                                                        echo "checked";
                                                                                                                                                    } ?> />
                        <label class="form-check-label text-info fw-bold" for="check"
                            id="checklabel<?php echo $page['id']; ?>"><?php if ($page["status_id"] == 2) {
                                                                                                                                                echo "Activate Product";
                                                                                                                                            } else {
                                                                                                                                                echo "Deactivate Product";
                                                                                                                                            } ?></label>
                    </div>
                    <dic class="col-12">
                        <div class="row">
                            <div class="col-lg-6 col-12">
                                <a onclick="send_id(<?php echo $page['id']; ?>);" class="btn btn-success d-grid"
                                    href="#">Update</a>
                            </div>

                            <div class="col-lg-6 col-12 mt-1 mt-lg-0">
                                <a class="btn btn-danger d-grid" href="#"
                                    onclick="deletemodal(<?php echo $page['id']; ?>);">Delete
                                </a>
                            </div>
                        </div>
                    </dic>


                </div>
            </div>

        </div>
    </div>
</div>



<?php
        }
    } else if ($qty == 2) {
        $prs = database::search("SELECT * FROM product WHERE `user_email`='" . $u["email"] . "' ORDER BY `qty` DESC");
        $qan = $prs->num_rows;

        for ($i = 0; $i < $qan; $i++) {
            $page = $prs->fetch_assoc();


        ?>

<div class="col-6 g-5">
    <div class="card mb-3 mt-3 ms-0">
        <div class="row mx-2">

            <div class="col-md-4 mt-3">
                <?php
                            $pimgs = database::search("SELECT * FROM image WHERE `product_id`='" . $page["id"] . "'");
                            $pir = $pimgs->fetch_assoc();
                            ?>
                <img src="<?php echo $pir["code"]; ?>" class="img-fluid rounded-start" alt="...">
            </div>
            <div class="col-md-8">
                <div class="card-body">
                    <h5 class="card-title fw-bold"><?php echo $page["title"]; ?></h5>
                    <span class="card-text text-primary fw-bold">Rs.<?php echo $page["price"]; ?></span>
                    <br>
                    <span class="card-text text-success fw-bold"><?php echo $page["qty"]; ?>&nbsp;
                        Items
                        Left</span>
                    <br>
                    <div class="form-check form-switch mb-2">

                        <input class="form-check-input" type="checkbox" id="check"
                            onchange="changestatus(<?php echo $page['id']; ?>);"
                            <?php if ($page["status_id"] == 2) {
                                                                                                                                                        echo "checked";
                                                                                                                                                    } ?> />
                        <label class="form-check-label text-info fw-bold" for="check"
                            id="checklabel<?php echo $page['id']; ?>"><?php if ($page["status_id"] == 2) {
                                                                                                                                                echo "Activate Product";
                                                                                                                                            } else {
                                                                                                                                                echo "Deactivate Product";
                                                                                                                                            } ?></label>
                    </div>
                    <dic class="col-12">
                        <div class="row">
                            <div class="col-lg-6 col-12">
                                <a onclick="send_id(<?php echo $page['id']; ?>);" class="btn btn-success d-grid"
                                    href="#">Update</a>
                            </div>

                            <div class="col-lg-6 col-12 mt-1 mt-lg-0">
                                <a class="btn btn-danger d-grid" href="#"
                                    onclick="deletemodal(<?php echo $page['id']; ?>);">Delete
                                </a>
                            </div>
                        </div>
                    </dic>


                </div>
            </div>

        </div>
    </div>
</div>



<?php
        }
    }
} else if (!empty($condition)) {
    if ($condition == 1) {
        $prs = database::search("SELECT * FROM product WHERE `user_email`='" . $u["email"] . "' AND `condition_id`='1' ");
        $an = $prs->num_rows;

        for ($i = 0; $i < $an; $i++) {
            $page = $prs->fetch_assoc();


        ?>

<div class="col-6 g-5">
    <div class="card mb-3 mt-3 ms-0">
        <div class="row mx-2">

            <div class="col-md-4 mt-3">
                <?php
                            $pimgs = database::search("SELECT * FROM image WHERE `product_id`='" . $page["id"] . "'");
                            $pir = $pimgs->fetch_assoc();
                            ?>
                <img src="<?php echo $pir["code"]; ?>" class="img-fluid rounded-start" alt="...">
            </div>
            <div class="col-md-8">
                <div class="card-body">
                    <h5 class="card-title fw-bold"><?php echo $page["title"]; ?></h5>
                    <span class="card-text text-primary fw-bold">Rs.<?php echo $page["price"]; ?></span>
                    <br>
                    <span class="card-text text-success fw-bold"><?php echo $page["qty"]; ?>&nbsp;
                        Items
                        Left</span>
                    <br>
                    <div class="form-check form-switch mb-2">

                        <input class="form-check-input" type="checkbox" id="check"
                            onchange="changestatus(<?php echo $page['id']; ?>);"
                            <?php if ($page["status_id"] == 2) {
                                                                                                                                                        echo "checked";
                                                                                                                                                    } ?> />
                        <label class="form-check-label text-info fw-bold" for="check"
                            id="checklabel<?php echo $page['id']; ?>"><?php if ($page["status_id"] == 2) {
                                                                                                                                                echo "Activate Product";
                                                                                                                                            } else {
                                                                                                                                                echo "Deactivate Product";
                                                                                                                                            } ?></label>
                    </div>
                    <dic class="col-12">
                        <div class="row">
                            <div class="col-lg-6 col-12">
                                <a onclick="send_id(<?php echo $page['id']; ?>);" class="btn btn-success d-grid"
                                    href="#">Update</a>
                            </div>

                            <div class="col-lg-6 col-12 mt-1 mt-lg-0">
                                <a class="btn btn-danger d-grid" href="#"
                                    onclick="deletemodal(<?php echo $page['id']; ?>);">Delete
                                </a>
                            </div>
                        </div>
                    </dic>


                </div>
            </div>

        </div>
    </div>
</div>


<?php
        }
    } else if ($condition == 2) {
        $prs = database::search("SELECT * FROM product WHERE `user_email`='" . $u["email"] . "' AND `condition_id`='2'");
        $an = $prs->num_rows;

        for ($i = 0; $i < $an; $i++) {
            $page = $prs->fetch_assoc();



        ?>

<div class="col-6 g-5">
    <div class="card mb-3 mt-3 ms-0">
        <div class="row mx-2">

            <div class="col-md-4 mt-3">
                <?php
                            $pimgs = database::search("SELECT * FROM image WHERE `product_id`='" . $page["id"] . "'");
                            $pir = $pimgs->fetch_assoc();
                            ?>
                <img src="<?php echo $pir["code"]; ?>" class="img-fluid rounded-start" alt="...">
            </div>
            <div class="col-md-8">
                <div class="card-body">
                    <h5 class="card-title fw-bold"><?php echo $page["title"]; ?></h5>
                    <span class="card-text text-primary fw-bold">Rs.<?php echo $page["price"]; ?></span>
                    <br>
                    <span class="card-text text-success fw-bold"><?php echo $page["qty"]; ?>&nbsp;
                        Items
                        Left</span>
                    <br>
                    <div class="form-check form-switch mb-2">

                        <input class="form-check-input" type="checkbox" id="check"
                            onchange="changestatus(<?php echo $page['id']; ?>);"
                            <?php if ($page["status_id"] == 2) {
                                                                                                                                                        echo "checked";
                                                                                                                                                    } ?> />
                        <label class="form-check-label text-info fw-bold" for="check"
                            id="checklabel<?php echo $page['id']; ?>"><?php if ($page["status_id"] == 2) {
                                                                                                                                                echo "Activate Product";
                                                                                                                                            } else {
                                                                                                                                                echo "Deactivate Product";
                                                                                                                                            } ?></label>
                    </div>
                    <dic class="col-12">
                        <div class="row">
                            <div class="col-lg-6 col-12">
                                <a onclick="send_id(<?php echo $page['id']; ?>);" class="btn btn-success d-grid"
                                    href="#">Update</a>
                            </div>

                            <div class="col-lg-6 col-12 mt-1 mt-lg-0">
                                <a class="btn btn-danger d-grid" href="#"
                                    onclick="deletemodal(<?php echo $page['id']; ?>);">Delete
                                </a>
                            </div>
                        </div>
                    </dic>


                </div>
            </div>

        </div>
    </div>
</div>


<?php
        }
    }
}