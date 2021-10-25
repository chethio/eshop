<?php
session_start();
require "connection.php";

if (isset($_SESSION["u"])) {
    $email = $_SESSION["u"]["email"];

    $invoicers = database::search("SELECT * FROM `invoice` WHERE `user_email`='$email'");
    $in = $invoicers->num_rows;

?>


    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>E-shop | Purchase History</title>

        <link rel="icon" href="resources/logo.svg">
        <link rel="stylesheet" href="bootstrap.css">
        <link rel="stylesheet" href="style.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">

        <script src="bootstrap.bundle.js"></script>
        <script src="bootstrap.js"></script>
    </head>

    <body>

        <div class="container-fluid">
            <?php require "header.php"; ?>

            <div class="row">

                <div class="col-12 text-center mb-3">
                    <span class="fs-1 fw-bold text-primary">Transaction History</span>
                </div>




                <div class="col-12">
                    <div class="row">

                        <?php
                        if ($in == 0) {
                        ?>
                            <div style="padding-top: 210px; height: 550px;" class="bg-link col-12 text-center">
                                <span class="fs-1 fw-bolder text-black-50">You have no items to
                                    show
                                    on your transaction
                                    history</span>
                            </div>

                        <?php
                        } else {

                        ?>

                            <div class="col-12 d-none d-lg-block">
                                <div class="row bg-light">
                                    <div class="col-1">
                                        <label class="form-label fw-bold">#</label>
                                    </div>
                                    <div class="col-3">
                                        <label class="form-label fw-bold">Order Details</label>
                                    </div>

                                    <div class="col-1 text-end">
                                        <label class="form-label fw-bold">Quantity</label>
                                    </div>

                                    <div class="col-2 text-end">
                                        <label class="form-label fw-bold">Amount</label>
                                    </div>

                                    <div class="col-2 text-end">
                                        <label class="form-label fw-bold">Purchase Date & Time</label>
                                    </div>

                                    <div class="col-3">
                                    </div>

                                    <div class="col-12">
                                        <hr class="hr1">
                                    </div>

                                </div>
                            </div>

                            <?php
                            for ($i = 0; $i < $in; $i++) {
                                $ir = $invoicers->fetch_assoc();
                            ?>

                                <div class="col-12">
                                    <div class="row">
                                        <div class="col-12 col-lg-1 bg-info text-center text-lg-end">
                                            <label class="fs-5 form-label text-white px-3 py-5  fw-bold"><?php echo $ir['order_id']; ?></label>
                                        </div>

                                        <div class="col-12 col-lg-3">
                                            <div class="row">
                                                <div class="card mx-2 my-3 mb-3" style="max-width: 540px;">
                                                    <div class="row g-0">
                                                        <div class="col-md-4">
                                                            <?php
                                                            $pid = $ir['product_id'];
                                                            $imgrs = database::search("SELECT * FROM `image` WHERE `product_id`='$pid'");
                                                            $n = $imgrs->num_rows;

                                                            for ($x = 0; $x < $n; $x++) {
                                                                $f = $imgrs->fetch_assoc();

                                                                $arr[$x] = $f["code"];
                                                            }

                                                            ?>
                                                            <img src="<?php echo $arr[0]; ?>" class="img-fluid rounded-start">
                                                        </div>
                                                        <div class="col-md-8">
                                                            <div class="card-body">
                                                                <?php
                                                                $productrs = database::search("SELECT * FROM `product` WHERE `id`='$pid'");
                                                                $pr = $productrs->fetch_assoc();

                                                                $sellerrs = database::search("SELECT * FROM `user` WHERE `email`='" . $pr["user_email"] . "'");
                                                                $sp = $sellerrs->fetch_assoc();
                                                                ?>

                                                                <h5 class="card-title"><?php echo $pr["title"]; ?></h5>
                                                                <p class="card-text"><b>Seller :
                                                                    </b><?php echo $sp["fname"] . " " . $sp["lname"]; ?></p>
                                                                <p class="card-text"><b>Price :
                                                                    </b>Rs.<?php echo $pr["price"]; ?>.00</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-12 col-lg-1 text-center text-lg-end">
                                            <span class="d-block d-lg-none fw-bold">Quantity</span>
                                            <span class="form-label fs-5 pt-5"><?php echo $ir["qty"]; ?></span>
                                        </div>

                                        <div class="col-12 col-lg-2 text-start text-lg-end bg-info fw-bold">
                                            <label class="form-label text-white fs-5 px-3 py-5 fw-bold">Rs.<?php echo $ir["total"]; ?>.00</label>
                                        </div>

                                        <div class="col-12 col-lg-2 text-center text-lg-end">
                                            <label class="form-label fs-4 pt-5"><?php echo $ir["date"]; ?></label>
                                        </div>

                                        <div class="col-12 col-lg-3">
                                            <div class="row">
                                                <div class="col-6 d-grid">
                                                    <button onclick="addfeedback(<?php echo $pid; ?>);" class="btn btn-secondary rounded border border-1 border-primary mt-5 fs-5"><i class="bi bi-info-circle-fill"></i> Feedback</button>
                                                </div>

                                                <div class="col-6 d-grid">
                                                    <button class="btn btn-danger rounded mt-5 fs-5"> <i class="bi bi-trash-fill"></i> Delete</button>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="col-12">
                                            <hr class="hr1">
                                        </div>
                                        <!-- modal -->


                                        <div class="modal fade" id="feedbackmodal<?php echo $pid; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel"><?php echo $pr["title"]; ?>
                                                        </h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <textarea class="form-control fs-5" id="feedtext<?php echo $pid; ?>" cols="30" rows="10"></textarea>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                        <button onclick="savefeedback(<?php echo $pid; ?>);" type="button" class="btn btn-primary">Add Feedback</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>


                                        <!-- modal -->
                                    </div>
                                </div>

                            <?php
                            }

                            ?>







                    </div>
                </div>

                <div class="col-12">
                    <hr class="hr1">
                </div>

                <div class="col-12 mb-3">
                    <div class="row">
                        <div class="col-lg-10 d-lg-block"></div>
                        <div class="col-12 col-lg-2 d-grid">
                            <button class="btn btn-danger fs-4"> <i class="bi bi-trash-fill"></i> Clear All Records</button>
                        </div>
                    </div>
                </div>



            <?php
                        }

            ?>






            </div>


            <?php require "footer.php"; ?>
        </div>

        <script src="script.js"></script>
    </body>

    </html>


<?php
}
?>