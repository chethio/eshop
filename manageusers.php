<?php
session_start();

require "connection.php";



if (isset($_SESSION["u"])) {

    $customer = $_SESSION["u"]["email"];


?>




<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-shop|Managusers</title>

    <link rel="icon" href="resources/logo.svg">
    <link rel="stylesheet" href="bootstrap.css">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <script src="jquery.min.js"></script>
</head>

<body style="background-color: #74EBD5; background-image: linear-gradient(90deg,#74ebd5 0%,#9face6 100%);">



    <div class="container-fluid">

        <div class="row">
            <div class="col-12 bg-light text-center rounded">
                <label class="form-label fs-2 fw-bold text-primary">Manage All Users</label>
            </div>


            <div class="col-12 bg-light rounded">
                <div class="row">
                    <div class="offset-0 offset-lg-3 col-12 col-lg-6 mt-3 mb-3">
                        <div class="row">
                            <div class="col-9">
                                <input type="text" class="form-control" id="searchtext">
                            </div>

                            <div class="col-3 d-grid">
                                <button class="btn btn-primary" id="searchbutton">Search</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 mt-3 mb-2">
                <div class="row">
                    <div class="col-2 col-lg-1 bg-primary pt-2 pb-2 text-end">
                        <span class="fs-4 fw-bold text-white">#</span>
                    </div>


                    <div class="col-2 bg-light pt-2 pb-2 d-none d-lg-block">
                        <span class="fs-4 fw-bold">Profile IMG</span>
                    </div>




                    <div class="col-2  bg-primary pt-2 pb-2 d-none d-lg-block">
                        <span class="fs-4 fw-bold">Email</span>
                    </div>

                    <div class="col-6 col-lg-2 bg-light pt-2 pb-2">
                        <span class="fs-4 fw-bold">User Name</span>
                    </div>

                    <div class="col-2  bg-primary pt-2 pb-2 d-none d-lg-block">
                        <span class="fs-4 fw-bold text-white">Mobile</span>
                    </div>

                    <div class="col-2 bg-light pt-2 pb-2 d-none d-lg-block">
                        <span class="fs-4 fw-bold">Registered Date</span>
                    </div>

                    <div class="col-4 col-lg-1 bg-light pt-2 pb-2"></div>

                </div>
            </div>






            <div id="user_data"></div>




        </div>


        <?php require "footer.php"; ?>
    </div>

    <script src="script.js"></script>
    <script src="bootstrap.js"></script>
</body>

</html>

<?php
}
?>