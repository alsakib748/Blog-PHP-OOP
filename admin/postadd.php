<?php 
    include_once "inc/header.php"; 
    include_once "inc/sidebar.php";
    include_once "../classes/Post.php";
    include_once "../classes/Category.php";


    $post = new Post();
    $ct = new Category();

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $post_add = $post->AddPost($_POST,$_FILES);
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
                        if (isset($post_add)) {
                        ?>
                            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                <strong><?php echo $post_add; ?></strong>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        <?php
                        }
                        ?>
                    </span>
                    <div class="card shadow">
                        <div class="card-header bg-secondary">
                            <h4 class="card-title fs-4 text-light">Add Post Form</h4>
                        </div>
                        <div class="card-body">
                            <form action="" method="POST" enctype="multipart/form-data">
                                <input type="hidden" name="userId" value="<?= Session::get('userId'); ?>" />
                                <div class="mb-3">
                                    <label class="form-label text-secondary fs-5">Post Title</label>
                                    <input type="text" class="form-control" name="title" placeholder="Post title" />
                                </div>

                                <div class="mb-3">
                                            <label class="form-label text-secondary fs-5">Post Category</label>
                                            <div class="">
                                                <select class="form-select" name="catId">
                                                    <option value= "" selected>Select Post Category</option>
                                            <?php 
                                                $allCat = $ct->AllCategory();
                                                if($allCat){
                                                    while($row = mysqli_fetch_assoc($allCat)){
                                            ?>
                                                <option value='<?= $row['catId']; ?>'><?= $row['catName']; ?></option>
                                            <?php
                                                    }
                                                }
                                            ?>    
                                                </select>
                                            </div>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label text-secondary fs-5">First Image</label>
                                    <input type="file" class="form-control" name="imageOne"  />
                                </div>

                                <div class="mb-3">
                                    <label class="form-label text-secondary fs-5">First Description</label>
                                    <textarea id="classic-editor" name="disOne"></textarea>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label text-secondary fs-5">Second Image</label>
                                    <input type="file" class="form-control" name="imageTwo"  />
                                </div>

                                <div class="mb-3">
                                    <label class="form-label text-secondary fs-5">Second Description</label>
                                    <textarea id="classic-editor-two" name="disTwo"></textarea>
                                </div>

                                <div class="mb-3">
                                            <label class="form-label text-secondary fs-5">Post Type</label>
                                            <div class="">
                                                <select class="form-select" name="postType">
                                                    <option selected>Select Post Type</option>
                                                    <option value="1">Post</option>
                                                    <option value="2">Slider</option>
                                                </select>
                                            </div>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label text-secondary fs-5">Post Tags</label>
                                    <input type="text" class="form-control" name="tags" placeholder="Post tags" />
                                </div>

                                <div>
                                    <input type="submit" class="btn btn-secondary shadow-none waves-effect waves-light me-1" name="submit" value="Add Post">
                                    <button type="reset" class="btn btn-danger shadow-none waves-effect">
                                        Cancel
                                    </button>
                                </div>

                            </form>

                        </div>
                    </div>
                </div> <!-- end col -->
            </div>

        </div>
    </div>
</div>



<?php include "inc/footer.php"; ?>