<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>eShop Admin Sign In</title>
    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="stylesheet" href="style.css" />
    <link rel="stylesheet" href="addproduct.css" />
    <link rel="icon" href="resources/logo.svg" />
</head>

<body style="background-color: #74EBD5; background-image: linear-gradient(90deg,#74EBD5 0%,#9FACE6 100%);">

    <div class="container-fluid justify-content-center" style="margin-top: 100px;">
        <div class="row align-content-center">

            <div class="col-12">

                <div class="row">
                    <div class="col-12 logo"></div>

                    <div class="col-12">
                        <p class="text-center title01">Hi,Welcome to eShop Admins</p>
                    </div>

                </div>

            </div>

            <div class="col-12 p-5">
                <div class="row">

                    <div class="col-6 d-none d-lg-block mainpic"></div>

                    <div class="col-12 col-lg-6 d-block">
                        <div class="row g-3">

                            <div class="col-12">
                                <p class="title02">Sign In To Your Account</p>
                            </div>
                            <div class="col-12">
                                <label class="form-label">Email </label>
                                <input type="email" class="form-control" name="" id="e">
                            </div>

                            <div class="col-12 col-lg-6 d-grid">
                                <button class="btn btn-primary" onclick="adminVerification();">Send verification code to login</button>
                            </div>
                            <div class="col-12 col-lg-6 d-grid">
                                <button class="btn btn-danger">Back to users login</button>
                            </div>

                        </div>
                    </div>

                </div>
            </div>

            <div class="modal fade" id="verificationModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Admin Verification</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <label for="" class="form-label">Enter the Verification Code you got by an Email</label>
                            <input type="text" class="form-control" id="vc">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary" onclick="verify();">Verify</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 d-none d-lg-block fixed-bottom text-center">
                <p> &copy; 2021 eShop.lk Alrights Reserved </p>
            </div>

        </div>
    </div>

    <script src="script.js"></script>
    <script src="bootstrap.js"></script>
    <script src="bootstrap.bundle.js"></script>
</body>

</html>