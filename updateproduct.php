<?php
session_start();
$product = $_SESSION["p"];

if (isset($product)) {


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Product</title>
    <link rel="stylesheet" href="bootstrap.css">
    <link rel="stylesheet" href="style.css">
    <link rel="icon" href="resources/logo.svg">
    <script src="script.js"></script>
</head>

<body>



    <div class="container-fluid">
        <div id="updateproductbox">
            <div class="row gy-3 mb-5">
                <div class="col-12 mb-2">
                    <h3 style="font-weight: bolder; font-size: 45px; font-family: sans-serif;"
                        class="h2 text-primary text-center">Update Products
                    </h3>
                </div>
                <!-- heading end -->



                <!-- search field -->
                <div class="col-12 mb-2">
                    <div class="row">

                        <div class="offset-0 offset-lg-1 col-12 col-lg-6">
                            <input value="<?php echo $product['id']; ?>" class="form-control text-center" type="text"
                                placeholder="Select Product You Want To Update" id="search" />
                        </div>

                        <div class="col-12 col-lg-4  d-grid">
                            <button onclick="searchtoupdate();" class="btn btn-primary mt-2 mt-lg-0">Search</button>
                        </div>
                    </div>
                </div>
                <!-- search field end -->

                <hr class="hr1">

                <!-- category, brand , model -->
                <div class="col-lg-12 mt-4">
                    <div class="row">
                        <div class="col-12 col-lg-4">
                            <div class="row">
                                <div class="col-12">
                                    <label class="form-label lbl1">Select Product Category</label>
                                </div>
                                <div class="col-12 mb-3">
                                    <select id="ca" class="form-select">
                                        <option>Select Category</option>
                                        <?php
                                            require "connection.php";
                                            $rs = database::search("SELECT * FROM  `category`");
                                            $n = $rs->num_rows;

                                            for ($x = 0; $x < $n; $x++) {
                                                $d = $rs->fetch_assoc();
                                            ?>

                                        <option value="<?php echo $d["id"]; ?>"><?php echo $d["name"]; ?></option>
                                        <?php
                                            }
                                            ?>
                                    </select>


                                </div>
                            </div>
                        </div>

                        <div class="col-12 col-lg-4">
                            <div class="row">
                                <div class="col-12">
                                    <label class="form-label lbl1">Select Brand</label>
                                </div>
                                <div class="col-12 mb-3">
                                    <select id="br" class="form-select" disabled>
                                        <option>Select Brand</option>
                                        <option value="2">Samsung</option>
                                        <option value="1">Apple</option>
                                        <option value="4">Sony</option>
                                        <option value="5">Huawei</option>
                                        <option value="3">Oppo</option>
                                        <option value="6">HTC</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 col-lg-4">
                            <div class="row">
                                <div class="col-12">
                                    <label class="form-label lbl1">Select Product Model</label>
                                </div>
                                <div class="col-12 mb-3">
                                    <select id="mod" class="form-select" disabled>
                                        <option>Select Model</option>
                                        <option value="2">Galaxy S6</option>
                                        <option value="1">Iphone 12</option>
                                        <option value="4">A95</option>
                                        <option value="5">P9</option>
                                        <option value="3">F12</option>
                                        <option value="6">U10</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- category, brand , model end -->
                <hr class="hr1">

                <!-- title -->
                <div class="col-12 mb-3">
                    <div class="row">
                        <div class="col-12">
                            <label class="form-label lbl1">Add a Title to your Product</label>
                        </div>

                        <div class="offset-lg-2 col-12 col-lg-8">
                            <input value="<?php echo $product['title']; ?>" type="text" class="form-control" id="ti">
                        </div>
                    </div>
                </div>
                <!-- title end -->
                <hr class="hr1">

                <!-- product condition -->
                <div class="col-12">
                    <div class="row">
                        <div class="col-12 col-lg-4">
                            <div class="row">
                                <div class="col-12">
                                    <label class="form-label lbl1">Select Product Condition</label>
                                </div>
                                <div class="offset-1 offset-lg-1 col-lg-3 col-10 form-check">
                                    <input class="form-check-input" name="check" type="radio" id="bn" checked disabled>
                                    <label class="form-check-label" for="new">
                                        Brandnew
                                    </label>
                                </div>
                                <div class="offset-1 offset-lg-1 col-lg-3 col-10 form-check">
                                    <input class="form-check-input" name="check" type="radio" id="us" disabled>
                                    <label class="form-check-label" for="use">
                                        Used
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 col-lg-4">
                            <div class="row">
                                <div class="col-12">
                                    <label class="form-label lbl1">Select Product Color</label>
                                </div>
                                <div class="col-12">
                                    <div class="row">
                                        <div class="offset-1 offset-lg-0 col-5 form-check col-lg-4">
                                            <input class="form-check-input" type="radio" name="colorradio" value="1"
                                                id="cl1" checked disabled>
                                            <label class="form-check-label" for="cl1">
                                                Gold
                                            </label>
                                        </div>

                                        <div class="offset-1 offset-lg-0 col-5 form-check col-lg-4">
                                            <input class="form-check-input" type="radio" name="colorradio" value="2"
                                                id="cl2" disabled>
                                            <label class="form-check-label" for="cl2">
                                                Silver
                                            </label>
                                        </div>

                                        <div class="offset-1 offset-lg-0 col-5 form-check col-lg-4">
                                            <input class="form-check-input" type="radio" name="colorradio" value="3"
                                                id="cl3" disabled>
                                            <label class="form-check-label" for="cl3">
                                                Graphite
                                            </label>
                                        </div>

                                        <div class="offset-1 offset-lg-0 col-5 form-check col-lg-4">
                                            <input class="form-check-input" type="radio" name="colorradio" value="4"
                                                id="cl4" disabled>
                                            <label class="form-check-label" for="cl4">
                                                Pacific Blue
                                            </label>
                                        </div>

                                        <div class="offset-1 offset-lg-0 col-5 form-check col-lg-4">
                                            <input class="form-check-input" type="radio" name="colorradio" value="5"
                                                id="cl5" disabled>
                                            <label class="form-check-label" for="cl5">
                                                Jet Black
                                            </label>
                                        </div>

                                        <div class="offset-1 offset-lg-0 col-5 form-check col-lg-4">
                                            <input class="form-check-input" type="radio" name="colorradio" value="6"
                                                id="cl6" disabled>
                                            <label class="form-check-label" for="cl6">
                                                Rose Gold
                                            </label>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>

                        <div class="col-12 col-lg-4">
                            <div class="row">
                                <div class="col-12">
                                    <label class="form-label lbl1">Add Product Quantity</label>
                                    <input value="<?php echo $product['qty']; ?>" type="number" class="form-control"
                                        min="0" max="100" id="qty">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- product condition end -->
                <hr class="hr1">

                <!-- cost, payment method -->
                <div class="col-12">
                    <div class="row">
                        <div class="col-12 col-lg-6">
                            <div class="row">
                                <div class="col-12">
                                    <label class="form-label lbl1">Cost Per Item</label>
                                </div>
                                <div class="input-group mb-3">
                                    <span class="input-group-text">Rs.</span>
                                    <input value="<?php echo $product['price']; ?>" type="text" class="form-control"
                                        aria-label="Amount (to the nearest rupee)" id="cost">
                                    <span class="input-group-text">.00</span>
                                </div>
                            </div>
                        </div>



                        <div class="col-12 col-lg-6">
                            <div class="row">
                                <div class="col-12">
                                    <label class="form-label lbl1">Approved Payment Methods</label>
                                </div>
                                <div class="col-12">
                                    <div class="row">

                                        <div class="offset-2 pm1 col-2"> </div>
                                        <div class="pm2 col-2"></div>
                                        <div class="pm3 col-2"></div>
                                        <div class="pm4 col-2"></div>

                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>


                <!-- cost, payment method end -->
                <hr class="hr1">
                <!-- delivery costs -->
                <div class="col-12 col-lg-6">
                    <div class="row">
                        <div class="col-12">
                            <label class="form-label lbl1">Delivery Cost</label>
                        </div>
                        <div class="col-12 col-lg-3 offset-lg-1">
                            <label class="form-label">Delivery Cost within colombo</label>
                        </div>
                        <div class="col-12 col-lg-7">
                            <div class="input-group mb-3">
                                <span class="input-group-text">Rs.</span>
                                <input value="<?php echo $product['delivery_fee_colombo']; ?>" type="text"
                                    class="form-control" aria-label="Amount (to the nearest rupee)" id="dwc">
                                <span class="input-group-text">.00</span>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="col-12 col-lg-6">
                    <div class="row mt-3">
                        <div class="col-12">
                            <label class="form-label lbl1"></label>
                        </div>
                        <div class="col-12 col-lg-3 offset-lg-1 ">
                            <label class="form-label">Delivery Cost out of Colombo</label>
                        </div>
                        <div class="col-12 col-lg-7">
                            <div class="input-group mb-3">
                                <span class="input-group-text">Rs.</span>
                                <input value="<?php echo $product['delivery_fee_other']; ?>" type="text"
                                    class="form-control" aria-label="Amount (to the nearest rupee)" id="doc">
                                <span class="input-group-text">.00</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- delivery costs end -->
                <hr class="hr1">

                <!-- Description -->
                <div class="col-12">

                    <div class="row">
                        <div class="col-12">
                            <label class="form-label lbl1">Product Description</label>
                        </div>
                        <div class="col-12">
                            <textarea class="form-control bg-light" cols="100" rows="30"
                                id="desc"><?php echo $product['description']; ?></textarea>
                        </div>
                    </div>
                </div>
                <!-- Description end -->
                <hr class="hr1">

                <!-- add product -->
                <div class="col-12">
                    <div class="row">
                        <div class="col-12">
                            <label class="form-label lbl1">Add Product Image</label>
                        </div>
                        <div class="col-12 mb-3">
                            <?php
                                if (isset($product)) {
                                    $img = database::search("SELECT * FROM `image` WHERE `product_id`='" . $product["id"] . "' ");
                                    $imgd = $img->fetch_assoc();
                                ?>
                            <img class="ms-3 col-5 col-lg-2 product-img" src="<?php echo $imgd["code"]; ?>" alt=""
                                id="prev">
                            <div class="col-12">
                                <div class="row">
                                    <div class="col-12 col-lg-6 ms-1 mt-2">
                                        <div class="row">
                                            <div class="col-12 col-lg-6">
                                                <input class="d-none" type="file" accept="img/*" id="imguploader" />
                                                <label class="btn btn-primary col-5 col-lg-8 ms-3 " for="imguploader"
                                                    onclick="changeimg();">Upload</label>
                                            </div>

                                            <!-- <div class="col-6 col-lg-4 d-grid">
                                            <button class="btn btn-primary">Add Product</button>
                                        </div> -->
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <?php
                                } else {



                                ?>
                            <img class="ms-3 col-5 col-lg-2 product-img" src="resources/addproductimg.svg" alt=""
                                id="prev">
                            <div class="col-12">
                                <div class="row">
                                    <div class="col-12 col-lg-6 ms-1 mt-2">
                                        <div class="row">
                                            <div class="col-12 col-lg-6">
                                                <input class="d-none" type="file" accept="img/*" id="imguploader" />
                                                <label class="btn btn-primary col-5 col-lg-8 ms-3 " for="imguploader"
                                                    onclick="changeimg();">Upload</label>
                                            </div>

                                            <!-- <div class="col-6 col-lg-4 d-grid">
                                            <button class="btn btn-primary">Add Product</button>
                                        </div> -->
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <?php
                                }
                                ?>

                        </div>

                    </div>
                </div>

                <!-- add product end -->
                <hr class="hr1">

                <!-- notice -->
                <div class="col-12">
                    <label class="form-label lbl1">Notice...</label>
                    <br>
                    <label>We are taking 5% of the product price from every product as a service charge.</label>
                </div>
                <!-- notice end -->


                <!-- save button -->
                <div class="col-12 mb-5">
                    <div class="row">
                        <div class="offset-0 offset-lg-4 col-12 col-lg-4 d-grid">
                            <button onclick="updateproduct();" class="btn btn-dark searchbutton">Update Product</button>
                        </div>

                        <!-- <div class="col-12 col-lg-2 d-grid">
                            <button class="btn btn-success searchbutton" onclick="changeproductview();">Add
                                Product</button>

                        </div> -->
                    </div>
                </div>

                <!-- save button end -->
            </div>

        </div>

    </div>





</body>

</html>
<?php
} else {
}
?>