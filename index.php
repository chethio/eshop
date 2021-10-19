<!DOCTYPE html>
<html lang="en">

<head>
    <title>E-Shop</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="icon" href="resources/logo.svg">
    <link rel="stylesheet" href="bootstrap.css">
    <link rel="stylesheet" href="style.css">
</head>

<body class="body1">
    <!-- header -->
    <div class="container-fluid vh-100 d-flex align-content-center justify-content-center">
        <div class="row d-flex align-content-center justify-content-center">
            <div class="col-12">

                <div class="row">
                    <div class="col-12 logo"></div>
                    <div class="col-12">
                        <p class="text-center head">Hi, Welcome to eShop!</p>
                    </div>
                </div>

            </div>
            <!-- header END -->


            <!-- content Signup-->
            <div class="col-12 px-5 p-5">
                <div class="row g-d">

                    <div class="col-6 d-none d-md-block d-lg-block mainpic">

                    </div>

                    <div class="col-12 col-lg-6" id="signup">

                        <div class="row g-3">

                            <div class="col-12">
                                <h2><b>Create New Account</b></h2>
                                <B>
                                    <p id="msg" class="text-danger"></p>
                                </B>
                            </div>



                            <div class="col-6">
                                <label class="form-label">First Name:</label>
                                <input type="text" class="form-control" id="fname">
                            </div>

                            <div class="col-6">
                                <label class="form-label">Last Name:</label>
                                <input type="text" class="form-control" id="lname">
                            </div>

                            <div class="col-12">
                                <label class="form-label">Email:</label>
                                <input type="email" class="form-control" id="email">
                            </div>

                            <div class="col-12">
                                <label class="form-label">Password:</label>
                                <input type="password" class="form-control" id="pass">
                            </div>

                            <div class="col-6">
                                <label class="form-label">Mobile:</label>
                                <input type="text" class="form-control" id="mobile">
                            </div>

                            <div class="col-6">
                                <label class="form-label">Gender:</label>
                                <select class="form-select" id="gender">
                                    <?php
                                    require "connection.php";

                                    $r = database::search("SELECT * FROM gender");
                                    $n = $r->num_rows;
                                    for ($x = 0; $x < $n; $x++) {
                                        $d = $r->fetch_assoc();

                                    ?>

                                        <option value="<?php echo $d["id"]; ?>"><?php echo $d["name"]; ?></option>

                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>

                            <div class="col-12 col-lg-6 d-grid">
                                <button onclick="signup();" class="btn btn-primary">Signup</button>
                            </div>


                            <div class="col-12 col-lg-6 d-grid">
                                <button onclick="changeview();" class="btn btn-dark">Already have an Account?
                                    Signin</button>
                            </div>
                        </div>

                    </div>

                    <!-- content Signin-->
                    <div class="col-12 col-lg-6 d-none" id="signin">

                        <div class="row g-3">

                            <div class="col-12">
                                <h2><b>Signin to your Account</b></h2>
                                <p id="msg2" class="text-danger"></p>
                            </div>

                            <div class="col-12">
                                <?php
                                $e = "";
                                $p = "";
                                if (isset($_COOKIE["e"])) {
                                    $e = $_COOKIE["e"];
                                }
                                if (isset($_COOKIE["p"])) {
                                    $p = $_COOKIE["p"];
                                }
                                ?>

                                <label class="form-label">Email:</label>
                                <input value="<?php echo $e; ?>" id="em2" type="email" class="form-control">
                            </div>

                            <div class="col-12">
                                <label class="form-label">Password:</label>
                                <input value="<?php echo $p; ?>" id="pass2" type="password" class="form-control">
                            </div>

                            <div class="col-6">
                                <div class="form-check">
                                    <input id="remember" type="checkbox" class="form-check-input" value="1">
                                    <label class="form-check-label">Remember Me</label>
                                </div>

                                <div id="loader" class="d-none" role="status">

                                </div>

                            </div>

                            <div class="col-6">
                                <div class="form-check">
                                    <a onclick="forgotpassword();" class="link-primary" href="#">Forgot Password?</a>
                                </div>

                            </div>



                            <div class="col-12 col-lg-6 d-grid">
                                <button onclick="signin();" class="btn btn-primary">Signin</button>
                            </div>


                            <div class="col-12 col-lg-6 d-grid">
                                <button onclick="changeview();" class="btn btn-danger">New To eShop? Join Now</button>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <!-- content END-->

            <!-- Footer-->
            <div class="col-12 fixed-bottom d-none d-lg-block">
                <p class="text-center">&copy; 2021 eShop.lk All Rights Reserved</p>
            </div>
        </div>

        <!-- modal-popup -->
        <div class="modal fade" tabindex="-1" id="forgetpassmodal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Password Reset</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row g-5">
                            <div class="col-6">
                                <label>New Password</label>
                                <div class="input-group">
                                    <input type="password" class="form-control" id="np">
                                    <button id="npb" onclick="showpass1();" class="btn btn-outline-primary" type="button">Show</button>
                                </div>
                            </div>


                            <div class="col-6">
                                <label>Retype New Password</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" id="rnp">
                                    <button id="npb2" onclick="showpass2();" class="btn btn-outline-primary" type="button">Show</button>
                                </div>
                            </div>

                            <div class="col-12">
                                <label>Enter Verification Code</label>
                                <input type="text" class="form-control" id="vc">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button class="btn btn-primary" onclick="resetpassword();">Reset</button>
                    </div>
                </div>
            </div>
        </div>


    </div>

    <script src="bootstrap.js"></script>
    <script src="script.js"></script>
</body>

</html>