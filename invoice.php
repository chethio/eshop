<?php
session_start();
require "connection.php";

if (isset($_SESSION["u"])) {
    $email = $_SESSION["u"]["email"];
    $oid = $_GET["id"];


?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-shop|Invoice</title>

    <link rel="icon" href="resources/logo.svg">
    <link rel="stylesheet" href="bootstrap.css">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">

</head>

<body class="mt-2" style="background-color: #f7f7ff;">
    <div class="container-fluid">
        <?php require "header.php"; ?>

        <div class="row">
            <div class="col-12">
                <hr class="hr1">
            </div>

            <div class="col-12 btn-toolbar justify-content-end">
                <button onclick="printDiv();" class="btn btn-dark me-2"><i class="bi bi-printer-fill"></i>
                    Print</button>
                <button class="btn btn-danger me-2"><i class="bi bi-file-earmark-pdf-fill"></i> Save as PDF</button>
            </div>

            <div class="col-12">
                <hr class="hr1">
            </div>




            <div id="GFG">
                <div class="col-12">
                    <div class="row">
                        <div class="col-6">
                            <div class="invoiceimg ms-3"></div>
                        </div>

                        <div class="col-6">
                            <div class="row">
                                <div class="col-12 text-end fw-bold text-decoration-underline text-primary">
                                    <h2>E-shop</h2>
                                </div>

                                <div class="col-12 text-end fw-bold">
                                    <span>Maradana, Colombo 10, Sri Lanka</span><br>
                                    <span>+94-771402560</span><br>
                                    <span>eshop@gmail.com</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <hr class="border border-2 border-primary">
                </div>


                <div class="col-12 mb-4">
                    <div class="row">
                        <div class="col-6">
                            <h5>INVOICE TO :</h5>
                            <?php
                                $addressrs = database::search("SELECT * FROM `user_has_address` WHERE `user_email`='$email'");
                                $ar = $addressrs->fetch_assoc();

                                ?>


                            <h3><?php echo $_SESSION['u']['fname'] . " " . $_SESSION['u']['lname'] ?></h3>
                            <span class="fw-bold"><?php echo $ar['line1'] . " " . $ar['line2'] ?></span><br>
                            <span class="fw-bold text-decoration-underline text-primary"><?php echo $email; ?></span>
                        </div>

                        <?php

                            $invoicers = database::search("SELECT * FROM `invoice` WHERE `order_id`='$oid'");


                            $ir = $invoicers->fetch_assoc();
                            ?>
                        <div class="col-6 text-end mt-4">
                            <h1 class="text-primary">INVOICE 0<?php echo $ir['id']; ?></h1>
                            <span class="fw-bold">Date and Time of Invoice : </span>&nbsp;
                            <span class="fw-bold"><?php echo $ir['date']; ?></span>
                        </div>



                    </div>
                </div>

                <div class="col-12">
                    <table class="table">
                        <thead>
                            <tr class="border border-1 border-white">
                                <th>#</th>
                                <th>Order ID & Product</th>
                                <th class="text-end">Unit Price</th>
                                <th class="text-end">Quantity</th>
                                <th class="text-end">Total</th>
                            </tr>
                        </thead>

                        <tbody>

                            <?php
                                $invoices = database::search("SELECT * FROM `invoice` WHERE `order_id`='$oid'");
                                $in = $invoicers->num_rows;

                                $subtotal = "0";

                                for ($i = 0; $i < $in; $i++) {
                                    $irs = $invoices->fetch_assoc();
                                    $iid = $irs["product_id"];

                                    $productrs = database::search("SELECT * FROM `product` WHERE `id`='$iid'");
                                    $pr = $productrs->fetch_assoc();

                                    $subtotal = $subtotal + $irs['total'];
                                ?>
                            <tr class="border-0" style="height: 70px;">
                                <td class="bg-primary text-white fs-3"><?php echo $irs['id']; ?></td>
                                <td> <a href="" class="fs-6 fw-bold p-2"><?php echo $irs['order_id']; ?></a><br>
                                    <a href="" class="fs-6 fw-bold p-2"><?php echo $pr["title"]; ?></a>
                                </td>
                                <td class="fs-6 text-end pt-3" style="background-color: rgb(199,199,199);">
                                    <?php echo $pr['price']; ?></td>
                                <td class="fs-6 text-end pt-3"><?php echo $irs['qty']; ?></td>
                                <td class="fs-6 text-end pt-3 text-white bg-primary">Rs.<?php echo $irs['total']; ?>.00
                                </td>
                            </tr>
                            <?php
                                }
                                ?>

                        </tbody>

                        <tfoot>
                            <tr>
                                <td colspan="2" class="border-0"></td>
                                <td colspan="2" class="fs-5 text-end">SUBTOTAL</td>
                                <td class="fs-5 text-end">Rs.<?php echo $subtotal; ?>.00</td>
                            </tr>

                            <tr>
                                <td colspan="2" class="border-0"></td>
                                <td colspan="2" class="fs-5 text-end border border-primary">Discount</td>
                                <td class="fs-5 text-end border border-primary">Rs.0</td>
                            </tr>

                            <tr>
                                <td colspan="2" class="border-0"></td>
                                <td colspan="2" class="fs-4 text-end border-0 text-primary">GRAND TOTAL</td>
                                <td class="fs-5 text-end border-0 text-primary">Rs.<?php echo $subtotal; ?>.00</td>
                            </tr>
                        </tfoot>
                    </table>

                </div>
                <div class="col-4 text-center" style="margin-top: -100px; margin-bottom: 50px;">
                    <span class="fs-1">Thank You!</span>
                </div>

                <div style="background-color: #e7f2ff;"
                    class="ms-1 col-12 mt-3 mb-3 border border-start border-end-0 border-top-0 border-bottom-0 border-5 border-primary rounded">
                    <div class="row">
                        <div class="col-12 mt-3 mb-3">
                            <label class="form-label fs-5 fw-bold">NOTICE : </label>
                            <label class="form-label fs-5 fw-bold">Purchased items could be returned before 7 days after
                                delivery!</label>
                        </div>
                    </div>
                </div>

                <div class="col-12">
                    <hr class="border border-2 border-primary">
                </div>

                <div class="col-12 mb-3 text-center">
                    <label for="form-label fs-6 text-black-50">
                        Invoice was generated by a computer program without the signature and valid seal
                    </label>
                </div>
            </div>
        </div>
        <?php require "footer.php"; ?>
    </div>
    <script src="script.js"></script>
    <script src="bootstrap.bundle.js"></script>
</body>

</html>

<?php
}
?>