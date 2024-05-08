<?php include "inc/header.php"; ?>


<!-- Sidebar Include -->
<?php include "inc/sidebar.php"; ?>


<?php
include "../classes/Category.php";
$ct = new Category();

if(isset($_GET["editId"])){
    $id = base64_decode($_GET["editId"]);

}else{
    header("Location: categorylist.php");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $catName =  isset($_POST["catName"]) ? $_POST["catName"] : " ";

    $catAdd = $ct->UpdateCategory($catName,$id);
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
                            <h4 class="card-title fs-4 text-light">Category Update Form</h4>
                        </div>
                        <div class="card-body">
                        <?php
                            $getData = $ct->getEditCat($id);
                            if($getData){
                                while($row = mysqli_fetch_assoc($getData)){
                        ?>
                            <form action="" method="POST">
                                <div class="mb-3">
                                    <label class="form-label text-secondary fs-5">New Category Name</label>
                                    <input type="text" class="form-control" name="catName" value="<?php echo $row["catName"]; ?>" placeholder="New category name" />
                                </div>

                                <div>

                                    <input type="submit" class="btn btn-success shadow-none waves-effect waves-light me-1" value="Update Category">

                                    <button type="reset" class="btn btn-secondary shadow-none waves-effect">
                                        Cancel
                                    </button>

                                </div>
                            </form>
                        <?php
                                }
                            }else{
                                echo "<h5 class='alert alert-warning text-center'>Invalid Edit Link</h5>";
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