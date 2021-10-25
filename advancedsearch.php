<?php
require "connection.php";


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Advanced Search</title>
    <link rel="stylesheet" href="bootstrap.css">
    <link rel="stylesheet" href="style.css">
    <link rel="icon" href="resources/logo.svg">
    <script src="jquery.min.js"></script>
</head>

<body class="bg-info">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 bg-body border border-primary border-start-0 border-end-0 border-top-0 ">
                <?php
                require "header.php";
                ?>
            </div>
            <div class="col-12 bg-white">
                <div class="row">
                    <div class="col-12 col-lg-4 offset-0 offset-lg-4">
                        <div class="row">
                            <div class="col-2 mt-2">
                                <div class="mb-3 logo">
                                </div>
                            </div>
                            <div class="col-10 mt-3">
                                <label class="text-black-50 fw-bolder fs-2 mt-4">Advanced Search</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="offset-0 offset-lg-2 col-12 col-lg-8 bg-white mt-3 mb-3 rounded">
                <div class="row">
                    <div class="col-12 col-lg-10 offset-0 offset-lg-1">
                        <div class="row">
                            <div class="col-12 col-lg-10 mt-3 mb-2">
                                <input id="k" type="text" class="form-control fw-bold" placeholder="Type Keyword To Search">
                            </div>

                            <div class="col-12 col-lg-2 d-grid mt-3 mb-2">
                                <button class="btn btn-primary" id="advancedsearchbutton">Search</button>
                            </div>
                            <div class="col-12">
                                <hr class="border border-primary border-3">
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-lg-10 offset-0 offset-lg-1">
                        <div class="row">
                            <div class="col-12">
                                <div class="row">
                                    <div class="col-lg-4 col-6 mb-3">
                                        <select id="c" class="form-select">
                                            <option value="0">Select Category</option>
                                            <?php
                                            $categoryrs = database::search("SELECT * FROM `category`");
                                            $cn = $categoryrs->num_rows;

                                            for ($x = 0; $x < $cn; $x++) {
                                                $cd = $categoryrs->fetch_assoc();
                                            ?>
                                                <option value="<?php echo $cd["id"]; ?>"><?php echo $cd["name"]; ?></option>
                                            <?php
                                            }
                                            ?>


                                        </select>
                                    </div>

                                    <div class="col-lg-4 col-6 mb-3">
                                        <select id="b" class="form-select">
                                            <option value="0">Select Brand</option>
                                            <?php
                                            $brandrs = database::search("SELECT * FROM `brand`");
                                            $bn = $brandrs->num_rows;

                                            for ($x = 0; $x < $bn; $x++) {
                                                $bd = $brandrs->fetch_assoc();
                                            ?>
                                                <option value="<?php echo $bd["id"]; ?>"><?php echo $bd["name"]; ?></option>
                                            <?php
                                            }
                                            ?>


                                        </select>
                                    </div>

                                    <div class="col-lg-4 col-12 mb-3">
                                        <select id="m" class="form-select">
                                            <option value="0">Select Model</option>
                                            <?php
                                            $modelrs = database::search("SELECT * FROM `model`");
                                            $mn = $modelrs->num_rows;

                                            for ($x = 0; $x < $mn; $x++) {
                                                $md = $modelrs->fetch_assoc();
                                            ?>
                                                <option value="<?php echo $md["id"]; ?>"><?php echo $md["name"]; ?></option>
                                            <?php
                                            }
                                            ?>


                                        </select>
                                    </div>

                                </div>
                            </div>


                            <div class="col-12">
                                <div class="row">
                                    <div class="col-lg-6 col-12 mb-3">
                                        <select id="con" class="form-select">
                                            <option value="0">Select Condition</option>
                                            <?php
                                            $conditionrs = database::search("SELECT * FROM `condition`");
                                            $con = $conditionrs->num_rows;

                                            for ($x = 0; $x < $con; $x++) {
                                                $cod = $conditionrs->fetch_assoc();
                                            ?>
                                                <option value="<?php echo $cod["id"]; ?>"><?php echo $cod["name"]; ?>
                                                </option>
                                            <?php
                                            }
                                            ?>


                                        </select>
                                    </div>

                                    <div class="col-lg-6 col-12 mb-3">
                                        <select id="clr" class="form-select">
                                            <option value="0">Select Color</option>
                                            <?php
                                            $colorrs = database::search("SELECT * FROM `color`");
                                            $cln = $colorrs->num_rows;

                                            for ($x = 0; $x < $cln; $x++) {
                                                $cld = $colorrs->fetch_assoc();
                                            ?>
                                                <option value="<?php echo $cld["id"]; ?>"><?php echo $cld["name"]; ?>
                                                </option>
                                            <?php
                                            }
                                            ?>


                                        </select>
                                    </div>


                                </div>
                            </div>


                            <div class="col-12">
                                <div class="row">
                                    <div class="col-lg-6 col-12 mb-3">
                                        <input id="pf" type="text" class="form-control" placeholder="Price From">
                                    </div>

                                    <div class="col-lg-6 col-12 mb-3">
                                        <input id="pt" type="text" class="form-control" placeholder="Price To">
                                    </div>

                                </div>
                            </div>



                        </div>
                    </div>
                </div>
            </div>

            <div class="offset-0 offset-lg-2 col-12 col-lg-8 bg-white mb-3 rounded">
                <div class="row">
                    <div class="col-12 col-lg-10 offset-0 offset-lg-1">


                        <div class="row" id="result">


                        </div>
                    </div>
                </div>
            </div>

        </div>


        <?php
        require "footer.php";
        ?>
    </div>


    <script src="bootstrap.bundle.js"></script>
    <script src="script.js"></script>
</body>

</html>