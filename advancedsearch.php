<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Advanced Search</title>
    <link rel="stylesheet" href="bootstrap.css">
    <link rel="stylesheet" href="style.css">
    <link rel="icon" href="resources/logo.svg">

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
                                <input type="text" class="form-control fw-bold" placeholder="Type Keyword To Search">
                            </div>

                            <div class="col-12 col-lg-2 d-grid mt-3 mb-2">
                                <button class="btn btn-primary">Search</button>
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
                                        <select id="" class="form-select">
                                            <option value="0">Select Category</option>
                                            <option value="">CAMERA</option>
                                        </select>
                                    </div>

                                    <div class="col-lg-4 col-6 mb-3">
                                        <select id="" class="form-select">
                                            <option value="0">Select Brand</option>
                                            <option value="">CAMERA</option>
                                        </select>
                                    </div>

                                    <div class="col-lg-4 col-12 mb-3">
                                        <select id="" class="form-select">
                                            <option value="0">Select Model</option>
                                            <option value="">CAMERA</option>
                                        </select>
                                    </div>

                                </div>
                            </div>


                            <div class="col-12">
                                <div class="row">
                                    <div class="col-lg-6 col-12 mb-3">
                                        <select id="" class="form-select">
                                            <option value="0">Select Condition</option>
                                            <option value="">CAMERA</option>
                                        </select>
                                    </div>

                                    <div class="col-lg-6 col-12 mb-3">
                                        <select id="" class="form-select">
                                            <option value="0">Select color</option>
                                            <option value="">CAMERA</option>
                                        </select>
                                    </div>


                                </div>
                            </div>


                            <div class="col-12">
                                <div class="row">
                                    <div class="col-lg-6 col-12 mb-3">
                                        <input type="text" class="form-control" placeholder="Price From">
                                    </div>

                                    <div class="col-lg-6 col-12 mb-3">
                                        <input type="text" class="form-control" placeholder="Price To">
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
                        <div class="row">


                            <!-- product cards -->

                            <div class="card mb-3 col-12 col-lg-5 mt-3 ms-lg-4 ms-0">
                                <div class="row g-0">
                                    <div class="col-md-4 mt-3">

                                        <img src="resources/products/6155562384488.png" class="img-fluid rounded-start"
                                            alt="...">
                                    </div>
                                    <div class="col-md-8">
                                        <div class="card-body">
                                            <h5 class="card-title fw-bold">Iphone 12</h5>
                                            <span class="card-text text-primary fw-bold">Rs.122332</span>
                                            <br>
                                            <span class="card-text text-success fw-bold">10
                                                Items
                                                Left</span>
                                            <br>

                                            <dic class="col-12">
                                                <div class="row">
                                                    <div class="col-lg-6 col-12">
                                                        <a class="btn btn-primary d-grid" href="#">Buy</a>
                                                    </div>

                                                    <div class="col-lg-6 col-12 mt-1 mt-lg-0">
                                                        <a class="btn btn-success d-grid" href="#">Add To Cart
                                                        </a>
                                                    </div>
                                                </div>
                                            </dic>


                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="card mb-3 col-12 col-lg-5 mt-3 ms-lg-4 ms-0">
                                <div class="row g-0">
                                    <div class="col-md-4 mt-3">

                                        <img src="resources/products/6155562384488.png" class="img-fluid rounded-start"
                                            alt="...">
                                    </div>
                                    <div class="col-md-8">
                                        <div class="card-body">
                                            <h5 class="card-title fw-bold">Iphone 12</h5>
                                            <span class="card-text text-primary fw-bold">Rs.122332</span>
                                            <br>
                                            <span class="card-text text-success fw-bold">10
                                                Items
                                                Left</span>
                                            <br>

                                            <dic class="col-12">
                                                <div class="row">
                                                    <div class="col-lg-6 col-12">
                                                        <a class="btn btn-primary d-grid" href="#">Buy Now</a>
                                                    </div>

                                                    <div class="col-lg-6 col-12 mt-1 mt-lg-0">
                                                        <a class="btn btn-success d-grid" href="#">Add To Cart
                                                        </a>
                                                    </div>
                                                </div>
                                            </dic>


                                        </div>
                                    </div>
                                </div>
                            </div>



                            <!-- product card -->
                            <div class="col-12">
                                <div class="row justify-content-center">
                                    <div class="offsey-4 col-4 text-center">
                                        <div class="offset-3 mb-5 pagination">
                                            <a href="">&laquo;</a>
                                            <a class="ms-1 active" href="">1</a>
                                            <a class="ms-1 " href="">2</a>

                                            <a href="">&raquo;</a>
                                        </div>

                                    </div>
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
    </div>


    <script src="bootstrap.bundle.js"></script>
    <script src="script.js"></script>
</body>

</html>