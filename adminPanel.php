<?php
require "connection.php";
session_start();

if (isset($_SESSION["a"])) {

    $a = $_SESSION["a"];


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>E-shop Admin Panel</title>
    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="stylesheet" href="style.css" />
    <link rel="stylesheet" href="addproduct.css" />
    <link rel="icon" href="resources/logo.svg" />
</head>


<body style="background-color: #74EBD5; background-image: linear-gradient(90deg,#74EBD5 0%,#9FACE6 100%);">

    <div class="container-fluid">
        <div class="row">

            <div class="col-12 col-lg-2">
                <div class="row">
                    <div class="align-items-start bg-dark col-12 text-center">
                        <div class="row g-1">

                            <div class="col-12 mt-5">
                                <h4 class="text-white"><?php echo $a["fname"] . " " . $a["lname"]; ?></h4>
                                <hr class="border border-1 border-white" />
                            </div>

                            <div class="nav flex-column nav-pills me-3 mt-3" role="tablist" aria-orientation="vertical">
                                <nav class="nav flex-column">
                                    <a class="nav-link active fs-5" aria-current="page" href="#">Dashboard</a>
                                    <a class="nav-link fs-5" href="manageusers.php">Manage Users</a>
                                    <a class="nav-link fs-5" href="#">Manage Products</a>
                                </nav>
                            </div>

                            <div class="col-12 mt-3">
                                <hr class="border border-1 border-white" />
                                <h4 class="text-white">Selling History</h4>
                                <hr class="border border-1 border-white" />
                            </div>

                            <div class="col-12 mt-3 d-grid">

                                <input id="sf" type="text" class="form-control" placeholder="Search From..."
                                    onfocus="this.type='date'" />
                                <input id="st" type="text" class="form-control mt-2" placeholder="Search To..."
                                    onfocus="this.type='date'" />

                                <a href="" id="historylink" class="btn btn-primary mt-2" onclick="dailysellings();">View
                                    Sellings</a>

                                <hr class="border border-1 border-white" />
                                <!-- <h4 style="cursor: pointer;" onclick="dailysellings();" class="text-white">Daily Selling
                                </h4> -->
                                <hr class="border border-1 border-white" />
                            </div>

                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 col-lg-10">
                <div class="row">

                    <div class="col-12 mt-3 mb-3 text-white">
                        <h2 class="fw-bold">Dashboard</h2>
                    </div>
                    <div class="col-12">
                        <hr>
                    </div>
                    <div class="col-12">
                        <div class="row g-1">

                            <div class="col-4 px-1">
                                <div class="row g-1">

                                    <div class="col-12 bg-primary text-white text-center rounded"
                                        style="height: 100px;">

                                        <br>
                                        <span class="fs-4 fw-bold">Daily Earnings</span>
                                        <br>

                                        <?php
                                            $d = new DateTime();
                                            $tz = new DateTimeZone("Asia/Colombo");
                                            $d->setTimezone($tz);
                                            $today = $d->format("Y-m-d");

                                            $thismonth = date("m");
                                            $thisyear = date("Y");
                                            $r = 0;
                                            $b = "0";
                                            $m = "0";
                                            $q = "0";
                                            $t = database::search("SELECT id FROM invoice WHERE `date` BETWEEN DATE_SUB(UTC_TIMESTAMP(), INTERVAL 24
                                            HOUR) AND UTC_TIMESTAMP
                                           GROUP BY HOUR(`date`);");
                                            $t = $t->num_rows;

                                            $f = "0";
                                            $ms = database::search("SELECT id FROM invoice WHERE `date` BETWEEN DATE_SUB(UTC_TIMESTAMP(), INTERVAL 1
MONTH) AND UTC_TIMESTAMP
GROUP BY HOUR(`date`);");
                                            $ms = $ms->num_rows;

                                            $ts = database::search("SELECT id FROM invoice");
                                            $ts = $ts->num_rows;

                                            $invoicers = database::search("SELECT * FROM `invoice` ");
                                            $in = $invoicers->num_rows;

                                            for ($x = 0; $x < $in; $x++) {
                                                $ir = $invoicers->fetch_assoc();

                                                $f = $f + $ir["qty"];

                                                $d = $ir["date"];

                                                $splitdate = explode(" ", $d); //explode helps us to split the data we enter into 2 or more parts  with a symbol of your choice....here space hase been used becaise space is used to seperate time amd date in the DB 
                                                $pdate = $splitdate[0];

                                                if ($pdate == $today) {
                                                    $b = $b + $ir["total"];

                                                    $q = $q + $ir["qty"];
                                                }

                                                $splitmonth = explode("-", $pdate);
                                                $pyear = $splitmonth[0];
                                                $pmonth = $splitmonth[1];

                                                if ($pyear == $thisyear) {
                                                    if ($pmonth == $thismonth) {
                                                        $m = $m + $ir["total"];
                                                        $r = $r + $ir["qty"];
                                                    }
                                                }
                                            }
                                            ?>
                                        <span class="fs-5">Rs.<?php echo $b; ?>.00</span>

                                    </div>

                                </div>
                            </div>

                            <div class="col-4 px-1">
                                <div class="row g-1">

                                    <div class="col-12 bg-white text-dark text-center rounded" style="height: 100px;">

                                        <br>
                                        <span class="fs-4 fw-bold">Monthly Earnings</span>
                                        <br>
                                        <span class="fs-5">Rs.<?php echo $m; ?>.00</span>

                                    </div>

                                </div>
                            </div>

                            <div class="col-4 px-1">
                                <div class="row g-1">

                                    <div class="col-12 bg-dark text-white text-center rounded" style="height: 100px;">

                                        <br>
                                        <span class="fs-4 fw-bold">Today Sellings</span>
                                        <br>
                                        <span class="fs-5"><?php echo $t; ?> Items</span>

                                    </div>

                                </div>
                            </div>

                            <div class="col-4 px-1">
                                <div class="row g-1">

                                    <div class="col-12 bg-secondary text-white text-center rounded"
                                        style="height: 100px;">

                                        <br>
                                        <span class="fs-4 fw-bold">Monthly Sellings</span>
                                        <br>
                                        <span class="fs-5"><?php echo $ms; ?> Items SOLD</span>

                                    </div>

                                </div>
                            </div>

                            <div class="col-4 px-1">
                                <div class="row g-1">

                                    <div class="col-12 bg-success text-white text-center rounded"
                                        style="height: 100px;">

                                        <br>
                                        <span class="fs-4 fw-bold">Total Sellings</span>
                                        <br>
                                        <span class="fs-5"><?php echo $ts; ?> Items</span>

                                    </div>

                                </div>
                            </div>

                            <div class="col-4 px-1">
                                <div class="row g-1">

                                    <div class="col-12 bg-danger text-white text-center rounded" style="height: 100px;">

                                        <br>
                                        <span class="fs-4 fw-bold">Total Engagements</span>
                                        <br>

                                        <?php
                                            $userrs = database::search("SELECT * FROM `user`");
                                            $un = $userrs->num_rows;
                                            ?>
                                        <span class="fs-5"><?php echo $un; ?> Members</span>

                                    </div>

                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="col-12">
                        <hr />
                    </div>

                    <div class="col-12 bg-dark">
                        <div class="row">

                            <div class="col-12 col-lg-2 text-center text-white mt-3 mb-3">
                                <label for="" class="form-lable fs-4 fw-bold text-white">Total Active Time</label>
                            </div>

                            <?php
                                $startdate = new DateTime("2021-10-01 00:00:00");
                                $tdate = new DateTime();
                                $tz = new DateTimeZone("Asia/Colombo");
                                $tdate->setTimezone($tz);
                                $enddate = new DateTime($tdate->format("Y-m-d H:i:s"));

                                $difference = $enddate->diff($startdate);
                                ?>

                            <div class="col-12 col-lg-10 text-center text-white mt-3 mb-3">
                                <label for=""
                                    class="form-lable fw-bold text-success"><?php echo $difference->format('%Y') . "Years  "    .     $difference->format('%m') . "Months  " . $difference->format('%d') . "Days  " . $difference->format('%H') . "Hours  " . $difference->format('%i') . "Minutes  " . $difference->format('%s') . "Seconds  "; ?></label>
                            </div>

                        </div>
                    </div>

                    <div class="col-10 col-lg-4 mt-3 mb-3 rounded bg-light offset-1">
                        <div class="row g-1">

                            <?php

                                $freq = database::search("SELECT `product_id`, COUNT(`product_id`) AS `value_occurrence` FROM `invoice` WHERE `date` LIKE '%" . $today . "%' GROUP BY `product_id` ORDER BY `value_occurrence` DESC LIMIT 1");
                                $freqnum = $freq->num_rows;
                                if ($freqnum == "0") {
                                ?>
                            <div class="col-12 text-center">
                                <h1>No items sold today</h1>
                            </div>

                            <?php
                                } else {



                                    $freqrow = $freq->fetch_assoc();


                                    $productrs = database::search("SELECT * FROM `product` WHERE `id`='" . $freqrow["product_id"] . "'");
                                    $pd = $productrs->fetch_assoc();

                                    $userrs = database::search("SELECT * FROM `user` WHERE `email`='" . $pd["user_email"] . "'");
                                    $usd = $userrs->fetch_assoc();

                                    $profilers = database::search("SELECT * FROM `profile_img` WHERE `user_email`='" . $pd["user_email"] . "'");
                                    $profd = $profilers->fetch_assoc();
                                ?>

                            <div class="col-12 text-center">
                                <label for="" class="form-label fs-4 fw-bold">Mostly Sold Items</label>
                            </div>

                            <div class="col-12">
                                <img src="resources/mobile images/iphone12.jpg" class="img-fluid rounded-top" alt=""
                                    srcset="">
                                <hr>
                            </div>

                            <div class="col-12 text-center">
                                <span class="fs-5 fw-bold"><?php echo $pd["title"]; ?></span>
                                <br>
                                <span class="fs-5 fw-bold"><?php echo $pd["qty"]; ?> Items Left</span>
                                <br>
                                <span class="fs-5 fw-bold">Rs.<?php echo $pd["price"]; ?>.00</span>
                            </div>

                            <div class="col-12">
                                <div class="firstplace"></div>
                            </div>

                        </div>
                    </div>

                    <div class="col-10 col-lg-4 mt-3 mb-3 rounded bg-light offset-1">
                        <div class="row g-1">

                            <div class="col-12 text-center">
                                <label for="" class="form-label fs-4 fw-bold">Mostly Famouse Seller</label>
                            </div>




                            <div class="col-12 justify-content-center">
                                <img src="<?php echo $profd["code"]; ?>" class="img-fluid rounded-top" alt="" srcset=""
                                    style="height: 290px; margin-left: 25%;">
                                <hr>
                            </div>

                            <div class="col-12 text-center">
                                <span class="fs-5 fw-bold"><?php echo $usd["fname"] . " " . $usd["lname"]; ?></span>
                                <br>
                                <span class="fs-5 fw-bold"><?php echo $usd["email"]; ?></span>
                                <br>
                                <span class="fs-5 fw-bold"><?php echo $usd["mobile"]; ?></span>
                            </div>

                            <div class="col-12">
                                <div class="firstplace"></div>
                            </div>

                        </div>
                    </div>
                    <?php
                                }
                    ?>
                </div>
            </div>

            <?php require "footer.php" ?>
        </div>
    </div>

    <script src="script.js"></script>
    <script src="bootstrap.js"></script>
    <script src="bootstrap.bundle.js"></script>
</body>

</html>

<?php
}
?>