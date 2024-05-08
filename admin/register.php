<?php
include_once "../classes/Register.php";
$re = new Register();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $addUser = $re->AddUser($_POST);
}
?>
<!doctype html>
<html lang="en">

<!-- Mirrored from themesbrand.com/minible/layouts/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 15 Jul 2021 13:44:25 GMT -->

<head>

    <meta charset="utf-8" />
    <title>Dashboard | Minible - Admin & Dashboard Template</title>
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

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link href="../css/style.css" id="app-style" rel="stylesheet" type="text/css" />

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

    <?php
    if (isset($addUser)) {
    ?>
        <div class="buttons d-none" id="alert-box">
            <!-- <button class="btn" id="success">Success</button>
                                <button class="btn" id="error">Error</button>
                                <button class="btn" id="warning">Warning</button> -->
            <span id="info" class="px-2"> <i class="fa-solid fa-circle-info"></i> <?php 
                echo $addUser; 
                ?>  
            </span>
        </div>
    <?php
    }
    ?>

    <section class="register-form">
        <div class="container">
            <div class="row d-flex align-items-center justify-content-center">
                <div class="col-md-5">

                    <div class="card shadow border-0 my-5">
                        <div class="card-header bg-secondary">
                            <h5 class="text-light fs-4">Registration Form</h5>
                        </div>
                        <div class="card-body">
                            <form action="" method="POST">
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label  text-secondary" style="font-size: 1rem;">Name</label>
                                    <input type="text" class="form-control" id="exampleInputEmail1" name="name">
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label  text-secondary" style="font-size: 1rem;">Phone</label>
                                    <input type="number" class="form-control" id="exampleInputEmail1" name="phone">
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label  text-secondary" style="font-size: 1rem;">Email address</label>
                                    <input type="email" class="form-control" id="exampleInputEmail1" name="email">
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputPassword1" class="form-label  text-secondary" style="font-size: 1rem;">Password</label>
                                    <input type="password" class="form-control" id="exampleInputPassword1" name="password">
                                </div>

                                <input type="submit" class="btn btn-success shadow-none py-1 px-3 rounded-1" value="Sign Up" style="font-size: 1rem;" />
                                <hr />
                                <span style="font-size: 1rem;" class="text-bolder">Already have an account! <a href="login.php" class="text-primary btn btn-sm btn-primary shadow-none text-light py-1 rounded-1 fs-6">login</a></span>
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

<script>
    $(document).ready(function() {


        function showAlert() {
            let data = "<?php
                        if (isset($addUser)) {
                            echo $addUser;
                        } else {
                            echo "";
                        }
                        ?>";
            if (data != "") {
                $("#alert-box").removeClass("d-none").fadeIn("slow").slideDown(1000);
            }

            setTimeout(() => {
                if (data != "") {
                    $("#alert-box").addClass("d-none").fadeOut("slow").slideUp(1000);
                }
            }, 3000);
        }

        showAlert();


    });
</script>