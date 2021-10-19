<?php
require "connection.php";
session_start();
if (isset($_SESSION["u"])) {
    $u = $_SESSION["u"];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eshop|UserProfile</title>
    <link rel="icon" href="resources/logo.svg">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="bootstrap.css">
</head>

<body class="bg-primary">

    <div class="container-fluid bg-white rounded mt-5 mb-5">
        <div class="row">
            <div class="col-md-3 border-right">
                <div class="d-flex flex-column align-items-center text-center p-3 py-5">
                    <?php
                        $profileimg = database::search("SELECT * FROM profile_img WHERE `user_email`='" . $u["email"] . "'");
                        $pn = $profileimg->num_rows;
                        if ($pn > 0) {

                            $p = $profileimg->fetch_assoc();
                        ?>

                    <img class="rounded mt-5" width="150px" src="<?php echo $p["code"]; ?>">
                    <?php
                        } else {

                        ?>

                    <img class="rounded mt-5" width="150px" src="resources/Profile.jpg">
                    <?php
                        }
                        ?>
                    <span class="font-weight-bold"><?php echo $u["fname"]; ?>&nbsp;<?php echo $u["lname"]; ?></span>

                    <span class="text-black-50"><?php echo $u["email"]; ?></span>
                    <?php
                } else {
                    ?>
                    <script>
                    window.location = "home.php";
                    </script>
                    <?php
                }
                    ?>
                    <input class="d-none" type="file" id="profileimg" accept="image/*" />
                    <label class="btn btn-primary mt-1" for="profileimg">Update Profile Image</label>
                </div>
            </div>
            <div class="col-md-5 border-right">
                <div class="p-3 py-5">
                    <div class="d-flex justify-content-between align-item-center mb-3">
                        <h4 class="text-start">Profile Settings</h4>
                    </div>
                    <div class="row mt-2">
                        <div class="col-md-6">
                            <label class="form-label">Name</label>
                            <input id="fname" class="form-control" type="text" placeholder="First Name"
                                value="<?php echo $u["fname"]; ?>" />
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Surname</label>
                            <input id="lname" class="form-control" type="text" placeholder="Last Name"
                                value="<?php echo $u["lname"]; ?>" />
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-12 mb-3">
                            <label class="form-label">Mobile Number</label>
                            <input id="mobile" class="form-control" type="text" placeholder="Enter Phone Number"
                                value="<?php echo $u["mobile"]; ?>" />
                        </div>

                        <div class="col-md-12 mb-3">
                            <label class="form-label">Password</label>
                            <input class="form-control" type="password" placeholder="Enter Password"
                                value="<?php echo $u["password"]; ?>" readonly />
                        </div>

                        <div class="col-md-12 mb-3">
                            <label class="form-label">Email Address</label>
                            <input id="email" class="form-control" type="text" placeholder="Enter Email ID"
                                value="<?php echo $u["email"]; ?>" disabled />
                        </div>

                        <div class="col-md-12 mb-3">
                            <label class="form-label">Registered Date & Time</label>
                            <input class="form-control" type="text" placeholder="Registered Date"
                                value="<?php echo $u["register_date"]; ?>" readonly />
                        </div>

                        <?php
                            $email = $u["email"];
                            $address = database::search("SELECT * FROM user_has_address WHERE `user_email`='$email'");
                            $n = $address->num_rows;
                            if ($n == 1) {
                                $d = $address->fetch_assoc();
                                // $locationid = $d["location_id"];

                            ?>

                        <div class="col-md-12 mb-3">
                            <label class="form-label">Address Line 1</label>
                            <input id="line1" class="form-control" type="text" placeholder="Enter Address Line 1"
                                value="<?php echo $d['line1']; ?>">
                        </div>

                        <div class="col-md-12 mb-3">
                            <label class="form-label">Address Line 2</label>
                            <input id="line2" class="form-control" type="text" placeholder="Enter Address Line 2"
                                value="<?php echo $d['line2'] ?>" />
                        </div>

                    </div>
                    <?php
                            } else {
                    ?>
                    <div class="col-md-12 mb-3">
                        <label class="form-label">Address Line 1</label>
                        <input id="line1" class="form-control" type="text" placeholder="Enter Address Line 1" value="">
                    </div>

                    <div class="col-md-12 mb-3">
                        <label class="form-label">Address Line 2</label>
                        <input id="line2" class="form-control" type="text" placeholder="Enter Address Line 2"
                            value="" />
                    </div>
                    <?php
                            }
                    ?>



                    <div class="row mt-2">

                        <?php
                        $email = $u["email"];
                        $address = database::search("SELECT * FROM user_has_address WHERE `user_email`='$email'");
                        $n = $address->num_rows;
                        if ($n == 1) {
                            $d = $address->fetch_assoc();
                            // $locationid = $d["location_id"];

                            $cityid = $d["city_id"];
                            $citysearch = database::search("SELECT * FROM city WHERE `id`='$cityid'");
                            $c = $citysearch->fetch_assoc();

                            $districtid = $c["district_id"];
                            $districtsearch = database::search("SELECT * FROM district WHERE `id`='$districtid'");
                            $d = $districtsearch->fetch_assoc();

                            $provinceid = $d["province_id"];
                            $provincesearch = database::search("SELECT * FROM province WHERE `id`='$provinceid'");
                            $p = $provincesearch->fetch_assoc();
                        ?>
                        <div class="col-md-6 mt-2">
                            <label class="form-label">Province</label>
                            <select id="province" class="form-control">

                                <option value="<?php echo $p["id"]; ?>"><?php echo $p["name"]; ?></option>
                                <?php
                                    $provinces = database::search("SELECT * FROM province");
                                    $np = $provinces->num_rows;
                                    for ($x = 0; $x < $np; $x++) {
                                        $pd = $provinces->fetch_assoc();
                                        if ($p["id"] != $pd["id"]) {
                                    ?>
                                <option value="<?php echo $pd["id"]; ?>"><?php echo $pd["name"]; ?></option>
                                <?php
                                        }

                                        ?>
                                <?php
                                    }
                                    ?>
                            </select>

                        </div>

                        <div class="col-md-6 mt-2">
                            <label class="form-label">District</label>
                            <select id="district" class="form-control">
                                <option value="<?php echo $d["id"]; ?>"><?php echo $d["name"]; ?></option>
                                <?php
                                    $districts = database::search("SELECT * FROM district");
                                    $nd = $districts->num_rows;
                                    for ($y = 0; $y < $nd; $y++) {
                                        $dd = $districts->fetch_assoc();
                                        if ($d["id"] != $dd["id"]) {
                                    ?>
                                <option value="<?php echo $dd["id"]; ?>"><?php echo $dd["name"]; ?></option>
                                <?php
                                        }
                                    }
                                    ?>
                            </select>
                        </div>


                        <div class="col-md-6 mt-2">
                            <label class="form-label">City</label>

                            <select id="city" class="form-control">
                                <option value="<?php echo $c["id"]; ?>"><?php echo $c["name"]; ?></option>
                                <?php
                                    $cities = database::search("SELECT * FROM city");
                                    $nc = $cities->num_rows;
                                    for ($z = 0; $z < $nc; $z++) {
                                        $dc = $cities->fetch_assoc();
                                        if ($c["id"] != $dc["id"]) {
                                    ?>
                                <option value="<?php echo $dc["id"]; ?>"><?php echo $dc["name"]; ?></option>
                                <?php
                                        }
                                    }
                                    ?>
                            </select>
                        </div>

                        <div class="col-md-6 mt-2">
                            <label class="form-label">Postal Code</label>
                            <input id="pc" value="<?php echo $dc["postal_code"]; ?>" class="form-control" type="text"
                                placeholder="Enter Your Postal Code">
                        </div>



                        <?php
                        } else {
                        ?>

                        <div class="col-md-6 mt-2">
                            <label class="form-label">Province</label>
                            <select id="province" class="form-control">
                                <option>Select Your Province</option>
                                <?php
                                    $provincers = database::search("SELECT * FROM province");
                                    $pn = $provincers->num_rows;
                                    for ($y = 0; $y < $pn; $y++) {
                                        $pd = $provincers->fetch_assoc();

                                    ?>
                                <option value="<?php echo $pd["id"]; ?>"><?php echo $pd["name"]; ?></option>
                                <?php

                                    }
                                    ?>
                            </select>

                        </div>

                        <div class="col-md-6 mt-2">
                            <label class="form-label">District</label>
                            <select id="district" class="form-control">
                                <option>Select Your District</option>
                                <?php
                                    $districts = database::search("SELECT * FROM district");
                                    $nd = $districts->num_rows;
                                    for ($y = 0; $y < $nd; $y++) {
                                        $dd = $districts->fetch_assoc();

                                    ?>
                                <option value="<?php echo $dd["id"]; ?>"><?php echo $dd["name"]; ?></option>
                                <?php

                                    }
                                    ?>
                            </select>
                        </div>



                        <div class="col-md-6 mt-2">
                            <label class="form-label">City</label>

                            <select id="city" class="form-control">
                                <option>Select Your City</option>
                                <?php
                                    $cities = database::search("SELECT * FROM city");
                                    $nc = $cities->num_rows;
                                    for ($z = 0; $z < $nc; $z++) {
                                        $dc = $cities->fetch_assoc();

                                    ?>
                                <option value="<?php echo $dc["id"]; ?>"><?php echo $dc["name"]; ?></option>
                                <?php

                                    }
                                    ?>
                            </select>
                        </div>

                        <div class="col-md-6 mt-2">
                            <label class="form-label">Postal Code</label>
                            <input id="pc" class="form-control" type="text" placeholder="Enter Your Postal Code">
                        </div>
                    </div>
                    <?php
                        }
                ?>


                    <div class="col-md-12">
                        <label class="form-label">Gender</label>

                        <?php

                    $genderid = $u["gender_id"];
                    $gender = database::search("SELECT * FROM gender WHERE `id`='$genderid'");
                    $gd = $gender->fetch_assoc();
                    ?>

                        <input class="form-control" type="text" placeholder="Gender"
                            value="<?php echo $gd['name']; ?>" />
                    </div>


                    <div class="mt-4 text-center">
                        <button class="btn btn-primary" onclick="updateprofile();">Update Profile</button>
                    </div>
                </div>


            </div>
        </div>

        <div class="col-md-4">
            <div class="row">
                <div class="p-3 py-5">
                    <div class="col-md-12">
                        <span class="header fw-bolder" style="font-size: 20px;">User Rating</span>
                        <span class="fa fa-star fs-4 text-warning"></span>
                        <span class="fa fa-star fs-4  text-warning"></span>
                        <span class="fa fa-star fs-4  text-warning"></span>
                        <span class="fa fa-star fs-4  text-warning"></span>
                        <span class="fa fa-star fs-4  text-black-50"></span>
                        <p>4.1 average based on 244 reviews.</p>
                        <hr class="hr1">
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-12">
                            <div>5 Star</div>
                        </div>
                        <div class="col-12">
                            <div class="progress">
                                <div class="progress-bar bg-success" role="progressbar" style="width: 60%"
                                    aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>

                        </div>
                        <div class="col-12">
                            <div class="text-end">
                                150
                            </div>
                        </div>




                        <div class="col-12">
                            <div>4 Star</div>
                        </div>
                        <div class="col-12">
                            <div class="progress">
                                <div class="progress-bar" role="progressbar" style="width: 40%" aria-valuenow="40"
                                    aria-valuemin="0" aria-valuemax="100"></div>
                            </div>

                        </div>
                        <div class="col-12">
                            <div class="text-end">
                                63
                            </div>
                        </div>



                        <div class="col-12">
                            <div>3 Star</div>
                        </div>
                        <div class="col-12">
                            <div class="progress">
                                <div class="progress-bar bg-info" role="progressbar" style="width: 30%"
                                    aria-valuenow="30" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>

                        </div>
                        <div class="col-12">
                            <div class="text-end">
                                63
                            </div>
                        </div>
                    </div>



                    <div class="col-12">
                        <div>2 Star</div>
                    </div>
                    <div class="col-12">
                        <div class="progress">
                            <div class="progress-bar bg-warning" role="progressbar" style="width: 20%"
                                aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>

                    </div>
                    <div class="col-12">
                        <div class="text-end">
                            15
                        </div>
                    </div>
                </div>




                <div class="col-12">
                    <div>1 Star</div>
                </div>
                <div class="col-12">
                    <div class="progress">
                        <div class="progress-bar bg-danger" role="progressbar" style="width: 10%" aria-valuenow="10"
                            aria-valuemin="0" aria-valuemax="100"></div>
                    </div>

                </div>
                <div class="col-12">
                    <div class="text-end">
                        6
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
    <script src="bootstrap.bundle.js"></script>
    <script src="jquery.min.js"></script>
</body>

</html>