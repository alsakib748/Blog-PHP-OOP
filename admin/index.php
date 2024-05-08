        <!--  Header Include -->
<?php 
        include "inc/header.php"; 
        include "inc/sidebar.php"; 
        include_once "../classes/Post.php";
        $post = new Post();
        include_once "../classes/Category.php";
        $ct = new Category();
        include_once "../classes/User.php";
        $us = new User();
?>
            <!-- ============================================================== -->
            <!-- Start right Content here -->
            <!-- ============================================================== -->
            <div class="main-content">

                <div class="page-content">
                    <div class="container-fluid">

                        <div class="row">
                            <div class="col-md-6 col-xl-3">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="float-end mt-2">
                                            <div id="total-revenue-chart"></div>
                                        </div>
                                    <?php 
                                    $total_post = $post->totalPost();
                                    if($total_post){
                                        $allPost = mysqli_num_rows($total_post);
                                    ?>    
                                        <div>
                                            <h4 class="mb-1 mt-1"><span data-plugin="counterup"><?= $allPost; ?></span></h4>
                                            <p class="text-muted mb-0">Total Post</p>
                                        </div>
                                    <?php
                                    }
                                    ?>    
                                        
                                        <p class="text-muted mt-3 mb-0"><span class="text-success me-1"><i class="mdi mdi-arrow-up-bold me-1"></i><?= $allPost; ?></span> since last week
                                        </p>
                                    </div>
                                </div>
                            </div> <!-- end col-->

                            <div class="col-md-6 col-xl-3">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="float-end mt-2">
                                            <div id="orders-chart"> </div>
                                        </div>
                                        <?php 
                                    $total_cat = $ct->totalCategory();
                                    if($total_cat){
                                        $allCat = mysqli_num_rows($total_cat);
                                    ?>    
                                        <div>
                                            <h4 class="mb-1 mt-1"><span data-plugin="counterup"><?= $allCat; ?></span></h4>
                                            <p class="text-muted mb-0">Total Category</p>
                                        </div>
                                    <?php 
                                    }
                                    ?>    
                                        <p class="text-muted mt-3 mb-0"><span class="text-danger me-1"><i class="mdi mdi-arrow-down-bold me-1"></i><?= $allCat; ?></span> since last week
                                        </p>
                                    </div>
                                </div>
                            </div> <!-- end col-->

                            <div class="col-md-6 col-xl-3">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="float-end mt-2">
                                            <div id="customers-chart"> </div>
                                        </div>
                                        <?php 
                                    $total_user = $us->totalUser();
                                    if($total_user){
                                        $allUser = mysqli_num_rows($total_user);
                                    ?>    
                                        <div>
                                            <h4 class="mb-1 mt-1"><span data-plugin="counterup"><?= $allUser; ?></span></h4>
                                            <p class="text-muted mb-0">Total User</p>
                                        </div>
                                        <p class="text-muted mt-3 mb-0"><span class="text-danger me-1"><i class="mdi mdi-arrow-down-bold me-1"></i><?= $allUser; ?></span> since last week
                                        </p>
                                    <?php
                                    }
                                    ?>    
                                    </div>
                                </div>
                            </div> <!-- end col-->

                            <!-- <div class="col-md-6 col-xl-3">

                                <div class="card">
                                    <div class="card-body">
                                        <div class="float-end mt-2">
                                            <div id="growth-chart"></div>
                                        </div>
                                        <div>
                                            <h4 class="mb-1 mt-1">+ <span data-plugin="counterup">12.58</span>%</h4>
                                            <p class="text-muted mb-0">Growth</p>
                                        </div>
                                        <p class="text-muted mt-3 mb-0"><span class="text-success me-1"><i class="mdi mdi-arrow-up-bold me-1"></i>10.51%</span> since last week
                                        </p>
                                    </div>
                                </div>
                            </div> end col -->
                        </div> <!-- end row-->

                    </div> <!-- container-fluid -->
                </div>
                <!-- End Page-content -->


            <!-- Footer Include -->
            <?php include "inc/footer.php"; ?>