<?php
include_once 'classes/SiteOption.php';
$sop = new SiteOption();
include_once 'classes/Post.php';
$pt = new Post();
include_once 'helpers/Format.php';
$fr = new Format();
?>

<footer class="site-footer">
    <div class="container">
        <div class="row mb-5">
            <?php
            $about = $sop->aboutInfo();
            if ($about) {
                while ($arow = mysqli_fetch_assoc($about)) {
            ?>
                    <div class="col-md-4">
                        <h3>About Us</h3>
                        <p class="mb-4">
                            <img src="admin/<?= $arow['image']; ?>" alt="Image placeholder" class="img-fluid">
                        </p>

                        <p><?= $fr->textShorten($arow['userDetails'], 100); ?>. <a href="about.php">Read More</a></p>
                    </div>
            <?php
                }
            }
            ?>

            <div class="col-md-6 ml-auto">
                <div class="row">
                    <div class="col-md-7">
                        <h3>Latest Post</h3>
                        <div class="post-entry-sidebar">
                            <ul>
                                <?php
                                $lpost = $pt->showPopularPost();
                                if ($lpost) {
                                    while ($lrow = mysqli_fetch_assoc($lpost)) {
                                ?>
                                        <li>
                                            <a href="">
                                                <img src="admin/<?= $lrow['imageOne']; ?>" alt="Image placeholder" class="mr-4">
                                                <div class="text">
                                                    <h4><?= $lrow['title']; ?></h4>
                                                    <div class="post-meta">
                                                        <span class="mr-2"><?= $fr->formatdate($lrow['created_at']); ?> </span> &bullet;
                                                        <span class="ml-2"><span class="fa fa-comments"></span> 3</span>
                                                    </div>
                                                </div>
                                            </a>
                                        </li>
                                <?php
                                    }
                                }
                                ?>


                            </ul>
                        </div>
                    </div>
                    <div class="col-md-1"></div>

                    <div class="col-md-4">

                        <div class="mb-5">
                            <h3>Quick Links</h3>
                            <ul class="list-unstyled">
                                <li><a href="#">About Us</a></li>
                                <li><a href="#">Categories</a></li>
                            </ul>
                        </div>

                        <div class="mb-5">
                            <h3>Social</h3>
                            <ul class="list-unstyled footer-social">
                                <?php
                                $allLink = $site->allSocial();
                                if ($allLink) {
                                    while ($link = mysqli_fetch_assoc($allLink)) {
                                ?>
                                        <li><a href="<?= $link['twitter']; ?>"><span class="fa fa-twitter"></span> Twitter</a></li>
                                        <li><a href="<?= $link['facebook']; ?>"><span class="fa fa-facebook"></span> Facebook</a></li>
                                        <li><a href="<?= $link['instagram']; ?>"><span class="fa fa-instagram"></span> Instagram</a></li>
                                        <li><a href="<?= $link['youtube']; ?>"><span class="fa fa-youtube-play"></span> Youtube</a></li>
                                <?php
                                    }
                                }
                                ?>

                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 text-center">
                <p class="small">
                    <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                    Copyright &copy; <script data-cfasync="false" src="/cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script>
                    <script>
                        document.write(new Date().getFullYear());
                    </script> All Rights Reserved | This template is made with <i class="fa fa-heart text-danger" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">AL SAKIB AYON</a>
                    <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                </p>
            </div>
        </div>
    </div>
</footer>
<!-- END footer -->

</div>

<!-- loader -->
<div id="loader" class="show fullscreen"><svg class="circular" width="48px" height="48px">
        <circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee" />
        <circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#f4b214" />
    </svg></div>

<script src="js/jquery-3.2.1.min.js"></script>
<script src="js/jquery-migrate-3.0.0.js"></script>
<script src="js/popper.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/owl.carousel.min.js"></script>
<script src="js/jquery.waypoints.min.js"></script>
<script src="js/jquery.stellar.min.js"></script>


<script src="js/main.js"></script>
</body>

</html>