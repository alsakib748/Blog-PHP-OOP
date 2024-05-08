<?php 
    include "inc/header.php"; 
    include "inc/sidebar.php"; 
    include "../classes/SiteOption.php";
    $site = new SiteOption();

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $update_links = $site->updateLinks($_POST);
    }
?>

<!-- ============================================================== -->
<!-- Start right Content here -->
<!-- ============================================================== -->
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-xl-8">
                    <span>
                        <?php
                        if (isset($update_links)) {
                        ?>
                            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                <strong><?php echo $update_links; ?></strong>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        <?php
                        }
                        ?>
                    </span>
                    <div class="card shadow">
                        <div class="card-header bg-secondary">
                            <h4 class="card-title fs-4 text-light">Add Social Links</h4>
                        </div>
                        <div class="card-body">
                        <?php 
                            $allSocial = $site->allSocial();
                            if($allSocial){
                                while($row = mysqli_fetch_assoc($allSocial)){
                        ?>
                            <form action=" " method="POST">
                                <div class="mb-3">
                                    <label class="form-label text-secondary fs-5">Twitter</label>
                                    <input type="url" class="form-control" name=" twitter" value="<?= $row["twitter"]; ?>" />
                                </div>

                                <div class="mb-3">
                                    <label class="form-label text-secondary fs-5">Facebook</label>
                                    <input type="url" class="form-control" name="facebook" value="<?= $row["facebook"]; ?>" />
                                </div>

                                <div class="mb-3">
                                    <label class="form-label text-secondary fs-5">Instagram</label>
                                    <input type="url" class="form-control" name="instagram" value="<?= $row["instagram"]; ?>" />
                                </div>

                                <div class="mb-3">
                                    <label class="form-label text-secondary fs-5">YouTube</label>
                                    <input type="url" class="form-control" name="youtube" value="<?= $row["youtube"]; ?>" />
                                </div>

                                <div>
                                    <input type="submit" class="btn btn-primary shadow-none waves-effect waves-light me-1" value="Update Social Links">

                                    <button type="reset" class="btn btn-secondary shadow-none waves-effect">
                                        Cancel
                                    </button>
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