<?php
session_start();
require "connection.php";

if (isset($_SESSION["u"])) {
    $email = $_SESSION["u"]["email"];

    $pr;
?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>E-shop|Watchlist</title>
        <link rel="icon" href="resources/logo.svg">
        <link rel="stylesheet" href="bootstrap.css">
        <link rel="stylesheet" href="style.css">
    </head>

    <body>
        <div class="container-fluid">
            <div class="row gx-2 gy-2">
                <div class="col-12">

                    <?php
                    require "header.php";
                    ?>

                    <div class="col-12 border border-secondary rounded p-3">
                        <div class="row">
                            <div class="col-12">
                                <label class="form-label fs-1 fw-bolder">Watchlist &hearts;</label>
                            </div>
                            <div class="col-12 col-lg-6">
                                <hr class="hr1">
                            </div>

                            <div class="col-12">
                                <div class="row">
                                    <div class="offset-0 offset-lg-2 col-12 col-lg-6 mb-3">
                                        <input type="text" class="form-control" placeholder="Search In Watchlist">
                                    </div>

                                    <div class=" col-12 col-lg-2 d-grid mb-3">
                                        <button class="btn btn-outline-primary">Search</button>
                                    </div>

                                </div>
                            </div>

                            <div class="col-12">
                                <hr class="hr1">
                            </div>


                            <div class="col-12 col-lg-2 border border-start-0 border-top-0 border-bottom-0 border-end border-2 border-primary">
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">Library</li>
                                    </ol>
                                </nav>
                                <nav class="nav nav-pills flex-column">
                                    <li class="nav-item">
                                        <a class="nav-link active" aria-current="page" href="#">My Watchlist</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#">My Cart</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#">Recently Viewed</a>
                                    </li>

                                </nav>

                            </div>


                            <?php
                            $watchlistrs = database::search("SELECT * FROM `watchlist` WHERE `user_email`='$email'");
                            $wn = $watchlistrs->num_rows;

                            if ($wn <= 0) {
                            ?>

                                <!-- without items -->
                                <div class="col-12 col-lg-9">
                                    <div class="row">
                                        <div class="col-12 emptyview"></div>
                                        <div class="col-12 text-center">
                                            <label class="form-label fs-1 mb-3 fw-bold">You have no items in yout
                                                Watchlist</label>
                                        </div>
                                    </div>
                                </div>
                                <!-- without items -->


                            <?php
                            } else {

                            ?>
                                <div class="col-12 col-lg-9">
                                    <div class="row g-2">
                                        <?php
                                        for ($i = 0; $i < $wn; $i++) {
                                            $wr = $watchlistrs->fetch_assoc();
                                            $wid = $wr["product_id"];

                                            $productrs = database::search("SELECT * FROM  `product` WHERE `id`='$wid'");
                                            $pn = $productrs->num_rows;
                                            if ($pn >= 1) {
                                                $pr = $productrs->fetch_assoc();


                                                $colors = database::search("SELECT * FROM `color` WHERE `id`='" . $pr["color_id"] . "'");
                                                $cr = $colors->fetch_assoc();

                                                $conditionrs = database::search("SELECT * FROM `condition` WHERE `id`='" . $pr["condition_id"] . "'");
                                                $conr = $conditionrs->fetch_assoc();

                                                $users = database::search("SELECT * FROM `user` WHERE `email`='" . $email . "'");
                                                $ur = $users->fetch_assoc();
                                        ?>


                                                <div class="card mb-3 mx-0 mx-lg-3 col-12">
                                                    <div class="row g-0">

                                                        <div class="col-md-4">
                                                            <?php
                                                            $imagers = database::search("SELECT * FROM `image` WHERE `product_id`='" . $pr["id"] . "' ");
                                                            $in = $imagers->num_rows;
                                                            $arr;

                                                            for ($x = 0; $x < $in; $x++) {
                                                                $ir = $imagers->fetch_assoc();
                                                                $arr["$x"] = $ir["code"];
                                                            }

                                                            ?>
                                                            <img style="height: 150px;" src="<?php echo $arr[0]; ?>" class="img-fluid rounded-start">
                                                        </div>
                                                        <div class="col-md-5">
                                                            <div class="card-body">
                                                                <h3 class="card-title"><?php echo $pr["title"]; ?></h3>
                                                                <span class="fw-bold text-black-50 ">Colour:
                                                                    <?php echo $cr["name"]; ?></span>&nbsp;
                                                                |
                                                                &nbsp;<span class="fw-bold text-black-50 ">Condition :
                                                                    <?php echo $conr["name"]; ?></span>
                                                                <br>
                                                                <span class="fw-bold text-black-50 fs-5">Price : </span>&nbsp;
                                                                <span class="fw-bold text-black fs-5 fw-bold"><?php echo $pr["price"]; ?></span>&nbsp;
                                                                <br>
                                                                <span class="fw-bold text-black-50 fs-5">Seller : </span>&nbsp;
                                                                <span class="fw-bold text-black fs-5 fw-bold"><?php echo $ur["fname"]; ?>
                                                                    <?php echo $ur["fname"]; ?></span>&nbsp;
                                                                <br>
                                                                <span class="fw-bold text-black-50 fs-5"><?php echo $ur["email"]; ?></span>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-3 mt-4">
                                                            <div class="card-body d-grid">
                                                                <a href="" class="btn btn-outline-success mb-2">Buy Now</a>
                                                                <a href="" class="btn btn-outline-warning mb-2">Add To Cart</a>
                                                                <a onclick="removefromwatchlist(<?php echo $wr['id']; ?>);" href="" class="btn btn-outline-danger mb-2">Remove</a>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>

                                    <?php
                                            }
                                        }
                                    }
                                    ?>
                                    </div>
                                </div>

                        </div>

                    </div>

                </div>
            </div>
        </div>





        <?php
        require "footer.php";
        ?>
        <script src="script.js"></script>
    </body>

    </html>
<?php
}
?>