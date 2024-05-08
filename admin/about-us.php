<?php 
include "inc/header.php"; 
include "inc/sidebar.php"; 
include "../classes/SiteOption.php";

$sop = new SiteOption();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $update = $sop->aboutUpdate($_POST,$_FILES);
}
?>

<!-- ============================================================== -->
<!-- Start right Content here -->
<!-- ============================================================== -->
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-xl-6">
                    <span>
                        <?php
                        if (isset($update)) {
                        ?>
                            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                <strong><?php echo $update; ?></strong>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        <?php
                        }
                        ?>
                    </span>
                    <div class="card shadow">
                        <div class="card-header bg-secondary">
                            <h4 class="card-title fs-4 text-light">About Us Form</h4>
                        </div>
                        <div class="card-body">
                        <?php 
                            $getAbout = $sop->aboutInfo();
                            if($getAbout){
                                while($row = mysqli_fetch_assoc($getAbout)){
                        ?>
                            <form action=" " method="POST" enctype="multipart/form-data">
                                <div class="mb-3">
                                    <label class="form-label text-secondary fs-5">User Name</label>
                                    <input type="text" class="form-control" name="username" value="<?= $row['username']; ?>" />
                                </div>

                                <div class="mb-3">
                                    <label class="form-label text-secondary fs-5">User Photo</label>
                                    <img src="<?= $row['image']; ?>" width="250" height="200" class='img-thumbnail'>
                                    <input type="file" class="form-control" name="image" placeholder="Category name" />
                                </div>

                            <div class="mb-3">
                                    <label class="form-label text-secondary fs-5">User Details</label> 
                                    <textarea name="user_details" class="form-control" id="" cols="30" rows="10"><?= $row['userDetails']; ?></textarea>
                                </div>

                                <div>

                                    <input type="submit" class="btn btn-primary shadow-none waves-effect waves-light me-1" value="Update About">

                                    <!-- <button type="reset" class="btn btn-secondary shadow-none waves-effect">
                                        Cancel
                                    </button> -->

                                </div>
                            </form>
                        <?php
                                }
                            }
                        ?>    
                            

                        </div>
                    </div>
                </div> <!-- end col -->
            </div>

        </div>
    </div>
</div>



<?php include "inc/footer.php"; ?>