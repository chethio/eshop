<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="bootstrap.css">
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-10 offset-1">
<div class="row">
   <div class="col-6 d-flex justify-content-start">
    <span class="text-start label1 "><a href="index.php">Signin first</a></span>
    <span class="text-start label2 ms-3">Help and Contact</span>
    <span class="text-start label2 ms-3">Sign Out</span>
   </div>


   <div class="col-6 d-flex justify-content-end">
    <span onclick="addproduct();" class="text-start label2">Sell</span>
  
    <div class="col-2 col-lg-6 col-md-6 dropdown me-3 me-md-3 me-lg-0">
        <button class="btn btn-light dropdown-toggle" type="button" id="dropdownMenuButton1"
            data-bs-toggle="dropdown" aria-expanded="false">
            My E-Shop
        </button>
        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
            <li><a class="dropdown-item" href="#">Wishlist</a></li>
            <li><a class="dropdown-item" href="#">Purchase History</a></li>
            <li><a class="dropdown-item" href="#">Messages</a></li>
            <li><a class="dropdown-item" href="#">Saved</a></li>
            <li><a class="dropdown-item" href="userprofile.php">My Profile</a></li>
            <li><a class="dropdown-item" href="#">My Sellings</a></li>
        </ul>
    </div>
    <span class="text-start label2 ms-3">Sign Out</span>
   </div>
</div>
            </div>
        </div>
    </div>

    <script src="bootstrap.bundle.js"></script>
</body>
</html>






<?php
                                $lid = $d["location_id"];
                                $city = database::search("SELECT * FROM city 
                                INNER JOIN location ON location.city_id=city.id
                                INNER JOIN user_has_address ON user_has_address.location_id=location.id
                                WHERE location_id='$lid';");
                                $nr = $city->num_rows;
                                if ($nr == 1) {
                                    $dt = $city->fetch_assoc();


                        ?>


                    <div class="row mt-2">
                        <div class="col-md-6">
                            <label class="form-label">City</label>
                            <input class="form-control" type="text" placeholder="Enter City Name"
                                value="<?php echo $dt['name']; ?>" />
                        </div>

                        <?php
                                } else {
                            ?>
                        <div class="row mt-2">
                            <div class="col-md-6">
                                <label class="form-label">City</label>
                                <input class="form-control" type="text" placeholder="Enter City Name" value="" />
                            </div>
                            <?php
                                }
                            }