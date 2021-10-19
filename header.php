<?php
error_reporting(0);
session_start();
if (isset($_SESSION["u"])) {
    $u = $_SESSION["u"];

?>




<!DOCTYPE html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="bootstrap.css">
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="row headrow">

        <div class="offset-lg-1 col-12 col-lg-4 align-self-start">
            <span class="text-start label1 ">Welcome Home <b><?php echo $u["fname"]; ?></b></span>

            <?php
        } else {


            ?>
            <div class="row headrow">

                <div class="offset-lg-1 col-12 col-lg-4 align-self-start">
                    <span class="text-start label1 "><a style="text-decoration: none;" href="index.php">Signin
                            first</a></span>
                    <?php
                }
                    ?>
                    <span class="text-start label2 ms-3">Help and Contact</span>
                    <?php
                    if (isset($_SESSION["u"])) {
                    ?>
                    <span class="text-start label2 ms-3" onclick="signout();">Sign Out</span>
                    <?php
                    } else {
                    ?>
                    <span class="text-start label2 ms-3 d-none" onclick="signout();">Sign Out</span>
                    <?php
                    }
                    ?>
                    <!-- <span class="text-start label2 ms-3" onclick="signout();">Sign Out</span> -->
                </div>
                <div class="offset-lg-5 col-12 col-lg-2 align-self-end">
                    <div class="row mt-1 mb-1">
                        <div class="col-1 col-lg-3 col-md-3">
                            <span onclick="addproduct();" class="text-start label2">Sell</span>
                        </div>

                        <div class="col-2 col-lg-6 col-md-6 dropdown me-3 me-md-3 me-lg-0">
                            <button class="btn btn-light dropdown-toggle" type="button" id="dropdownMenuButton1"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                My E-Shop
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                <li><a class="dropdown-item" href="wishlist.php">Wishlist</a></li>
                                <li><a class="dropdown-item" href="#">Purchase History</a></li>
                                <li><a class="dropdown-item" href="#">Messages</a></li>
                                <li><a class="dropdown-item" href="myproducts.php">My Products</a></li>
                                <li><a class="dropdown-item" href="userprofile.php">My Profile</a></li>
                                <li><a class="dropdown-item" href="#">My Sellings</a></li>
                            </ul>
                        </div>

                        <div onclick="gotocart();" class="col-3 col-md-3 col-lg-3 mt-1 ms-5 ms-md-3 ms-lg-0 carticon">
                        </div>
                    </div>

                </div>

            </div>
            <script src="script.js"></script>
</body>

</html>