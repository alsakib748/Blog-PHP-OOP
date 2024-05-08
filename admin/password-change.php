<?php

include_once "../classes/ChangePassword.php";
$cng = new ChangePassword();

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        // $password = isset($_POST["password"]) ? $_POST["password"] : " ";
        
        $reset = $cng->changePass($_POST);
    }

?>

<!doctype html>
<html lang="en">

<!-- Mirrored from themesbrand.com/minible/layouts/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 15 Jul 2021 13:44:25 GMT -->

<head>

    <meta charset="utf-8" />
    <title>Change Password</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesbrand" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="assets/images/favicon.ico">

    <!-- Bootstrap Css -->
    <link href="assets/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="assets/css/icons.min.css" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="assets/css/app.min.css" id="app-style" rel="stylesheet" type="text/css" />

    <style>
        /* .notifications{
            position: relative;
        } */
        .buttons {
            min-width: 250px;
            min-height: 40px;
            position: absolute;
            top: 15px;
            right: 15px;
            display: inline-flex;
            flex-direction: row;
            align-items: center;
            justify-content: center;
            background-color: greenyellow;
            color: black;
            border-radius: 5px;
            z-index: 1010;
        }

        #info {
            font-size: 1rem;
        }

        #info i {
            font-size: 1rem;
        }
    </style>

</head>


<body>

    <section class="login-form">
        <div class="container">
            <div class="row d-flex align-items-center justify-content-center">
                <div class="col-md-5 my-5">
                    <span class="my-1">
                        <?php
                        if (isset($reset)) {
                        ?>
                            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                <strong><?php echo $reset; ?></strong>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        <?php
                        }
                        ?>
                    </span>
                    <div class="card shadow border-0 ">
                        <div class="card-header bg-secondary">
                            <h5 class="text-light fs-4">Password Change</h5>
                        </div>
                        <div class="card-body">
                            <form action="" method="POST">
                                
                                <input type="hidden" name="token" required class="form-control" value="<?php 
                                    if(isset($_GET["token"])){
                                        echo $_GET["token"];
                                    }
                                ?>">
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label  text-secondary" style="font-size: 1rem;">Email address</label>
                                    <input type="email" class="form-control" id="exampleInputEmail1" name="email" value="<?php 
                                        echo isset($_GET["email"]) ? $_GET["email"] : "Email Not found";
                                    ?>">
                                </div>
                                
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label  text-secondary" style="font-size: 1rem;">New Password</label>
                                    <input type="password" class="form-control" id="exampleInputEmail1" name="newpassword">
                                </div>

                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label  text-secondary" style="font-size: 1rem;">Confirm Password</label>
                                    <input type="password" class="form-control" id="exampleInputEmail1" name="c_password">
                                </div>

                                <input type="submit" class="btn btn-primary shadow-none w-100" value="Change Password" name="change_password">

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!-- JAVASCRIPT -->
    <script src="assets/libs/jquery/jquery.min.js"></script>
    <script src="assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/libs/metismenu/metisMenu.min.js"></script>
    <script src="assets/libs/simplebar/simplebar.min.js"></script>
    <script src="assets/libs/node-waves/waves.min.js"></script>
    <script src="assets/libs/waypoints/lib/jquery.waypoints.min.js"></script>
    <script src="assets/libs/jquery.counterup/jquery.counterup.min.js"></script>

    <!-- apexcharts -->
    <script src="assets/libs/apexcharts/apexcharts.min.js"></script>

    <script src="assets/js/pages/dashboard.init.js"></script>

    <!-- App js -->
    <script src="assets/js/app.js"></script>

</body>


<!-- Mirrored from themesbrand.com/minible/layouts/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 15 Jul 2021 13:44:57 GMT -->

</html>