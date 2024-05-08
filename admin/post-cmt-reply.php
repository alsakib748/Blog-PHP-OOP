<?php 
include "inc/header.php"; 
include "inc/sidebar.php"; 
include "../classes/Comment.php";
$cmt = new Comment();

if(isset($_GET['replyCmt'])){
    $cmtId = base64_decode($_GET['replyCmt']);
}

if($_SERVER["REQUEST_METHOD"] == "POST") {
    $reply =  isset($_POST["reply"]) ? $_POST["reply"] : " ";

    $cmtReply = $cmt->AddReply($reply,$cmtId);
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
                        if (isset($cmtReply)) {
                        ?>
                            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                <strong><?php echo $cmtReply; ?></strong>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        <?php
                        }
                        ?>
                    </span>
                    <div class="card shadow">
                        <div class="card-header bg-secondary">
                            <h4 class="card-title fs-4 text-light">Reply Post Comment</h4>
                        </div>
                        <div class="card-body">
                        <?php 
                            $select_cmt = $cmt->commentSelect($cmtId);
                            if($select_cmt){
                                while($row = mysqli_fetch_assoc($select_cmt)){
                        ?>
                            <form action=" " method="POST">
                                <div class="mb-3">
                                    <label class="form-label text-secondary fs-5">Reply Message</label>
                                    <textarea class="form-control" name="reply" rows="5" cols=""><?= $row['admin_reply']; ?></textarea>
                                </div>

                                <div>

                                    <input type="submit" class="btn btn-primary shadow-none waves-effect waves-light me-1" value="Send Reply">

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