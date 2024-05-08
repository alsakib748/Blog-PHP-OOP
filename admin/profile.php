<?php include "inc/header.php"; ?>


<!-- Sidebar Include -->
<?php include "inc/sidebar.php"; ?>


<?php
include "../classes/Category.php";
$ct = new Category();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $catName =  isset($_POST["catName"]) ? $_POST["catName"] : " ";

    $catAdd = $ct->AddCategory($catName);
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
                        if (isset($catAdd)) {
                        ?>
                            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                <strong><?php echo $catAdd; ?></strong>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        <?php
                        }
                        ?>
                    </span>
                    <div class="card shadow">
                        <div class="card-header bg-secondary">
                            <div class="row">
                                <div class="col-md-6 d-md-flex align-items-md-center justify-content-md-start">
                                    <h4 class="card-title fs-4 text-light">User Profile</h4>
                                </div>
                                <div class="col-md-6 d-md-flex align-items-md-center justify-content-md-end">
                                    <a href="edit-profile.php?uid=<?= base64_encode(Session::get('userId')); ?>" class="btn btn-info">Edit Profile</a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">

                            <table class="table table-bordered table-responsive">
                                <tr>
                                    <td><label for="">User Name</label></td>
                                    <td><?= Session::get('username'); ?></td>
                                </tr>
                                <tr>
                                    <td><label for="">User Photo</label></td>
                                    <td><img src="<?= Session::get('userImage'); ?>" width="250" height="200" /></td>
                                </tr>
                            </table>

                        </div>
                    </div>
                </div> <!-- end col -->
            </div>

        </div>
    </div>
</div>



<?php include "inc/footer.php"; ?>