<?php 
    include "inc/header.php"; 
    include "inc/sidebar.php"; 
    include "../classes/SiteOption.php";
    $site = new SiteOption();

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $update_logo = $site->updateLogo($_POST);
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
                        if (isset($update_logo)) {
                        ?>
                            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                <strong><?php echo $update_logo; ?></strong>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        <?php
                        }
                        ?>
                    </span>
                    <div class="card shadow">
                        <div class="card-header bg-secondary">
                            <h4 class="card-title fs-4 text-light">Add Site Logo</h4>
                        </div>
                        <div class="card-body">
                        <?php 
                            $logo = $site->siteLogo();
                            if($logo){
                                while($row = mysqli_fetch_assoc($logo)){
                        ?>
                            <form action=" " method="POST">
                                <div class="mb-3">
                                    <label class="form-label text-secondary fs-5">Site Logo</label>
                                    <input type="text" class="form-control" name=" logo" value="<?= $row['logoName']; ?>" />
                                </div>

                                <div>
                                    <input type="submit" class="btn btn-primary shadow-none waves-effect waves-light me-1" value="Update Logo Name">

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