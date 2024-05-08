<?php 
    
    include "inc/header.php"; 
    include "inc/sidebar.php";
    include "../classes/Post.php";

    $pt = new Post();

    include_once '../classes/Comment.php';
    $cmt = new Comment();

    include_once '../helpers/Format.php';
    $fr = new Format();

    $userId = Session::get('userId'); 

// active post
if(isset($_GET["active"])){
    $aid = $_GET["active"];
    $active = $cmt->activePost($aid);
}

// deactive post
if(isset($_GET["deactive"])){
    $did = $_GET["deactive"];
    $deactive = $cmt->deactivePost($did);
}

// delete post
if(isset($_GET["delcmt"])){
    $id = base64_decode($_GET["delcmt"]);
    $deleteCmt = $cmt->deleteCmt($id);
}

if (!isset($_GET["id"])) {
    // echo "<meta http-equiv='refresh' content='0;URL=?id=ahr'/>";
}

?>

<!-- ============================================================== -->
<!-- Start right Content here -->
<!-- ============================================================== -->
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-12">
                    <span>
                        <?php
                        if (isset($active)) {
                        ?>
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <strong><?php echo $active; ?></strong>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        <?php
                        }
                        ?>
                    </span>
                    <span>
                        <?php
                        if (isset($deactive)) {
                        ?>
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <strong><?php echo $deactive; ?></strong>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        <?php
                        }
                        ?>
                    </span>
                    <span>
                        <?php
                        if (isset($deleteCmt)) {
                        ?>
                            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                <strong><?php echo $deleteCmt; ?></strong>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        <?php
                        }
                        ?>
                    </span>
                    <div class="card shadow">
                        <div class="card-header bg-secondary">
                            <div class="card-title fs-5 text-white">ALL POST COMMENT</div>
                        </div>
                        <div class="card-body">

                            <table id="datatable" class="table table-bordered dt-responsive nowrap text-center" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                    <tr>
                                        <th>SL</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Website</th>
                                        <th>Comment</th>
                                        <th>Admin Reply</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php
                                    $allComment = $cmt->adminComment($userId);
                                    if ($allComment && mysqli_num_rows($allComment) > 0) {
                                        $i = 1;
                                        while ($row = mysqli_fetch_assoc($allComment)) {
                                    ?>
                                            <tr>
                                                <td><?php echo $i; ?></td>
                                                <td><?php echo $row["name"]; ?></td>
                                                <td><?php echo $row["email"]; ?></td>
                                                <td><?php echo $row["website"]; ?></td>
                                                <td><?php echo $row["message"]; ?></td>
                                                <td><?php echo $row["admin_reply"]; ?></td>
                                                
                                                <td>
                                                    <!-- <a href="catEdit.php?editId=<?php //echo base64_encode($row["catId"]); 
                                                                                        ?>" class="btn btn-sm btn-success ">Edit</a>
                                                    <a href="?delCat=<?php //base64_encode($row["catId"]); 
                                                                        ?>" onclick = "return confirm('Are you sure to delete - <?php //echo $row['catName']; 
                                                                                                                                ?>')"  class="btn btn-sm btn-danger ">Delete</a> -->
                                                    <a href="post-cmt-reply.php?replyCmt=<?= base64_encode($row["cmtId"]); ?>" class="btn btn-sm btn-primary waves-effect waves-light"><i class="fas fa-reply"></i></a>
                                                    <a href="?delcmt=<?=  base64_encode($row["cmtId"]); ?>" onclick = "return confirm('Are You Sure To Delete ?')" class="btn btn-sm btn-danger waves-effect waves-light"><i class="fas fa-trash"></i> </a>
                                                    <a href="#" class="btn btn-sm btn-info waves-effect waves-light" data-bs-toggle="modal" data-bs-target="#myModal<?= $row['postId'] ?>"><i class="fas fa-eye"></i> </a>
                                            <?php 
                                                if($row['status'] == 0){
                                            ?>
                                                <a href="?deactive=<?= $row['cmtId']; ?>" class="btn btn-sm btn-warning waves-effect waves-light"><i class="fas fa-arrow-down"></i> </a>
                                            <?php
                                                }else{
                                            ?>
                                                <a href="?active=<?= $row["cmtId"]; ?>" class="btn btn-sm btn-success waves-effect waves-light"><i class="fas fa-arrow-up"></i> </a>
                                            <?php
                                                }
                                            ?>
                                                    

                                                </td>
                                            </tr>
                                    <?php
                                            $i++;
                                        }
                                    }else{
                                        echo "<h4 class='alert alert-warning text-center'>No Post Found!</h4>";
                                        // echo $notFoundPost;
                                    }
                                    ?>
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div> <!-- end col -->
            </div> <!-- end row -->

        </div>
    </div>
</div>

<?php
$modelData = $pt->modelData();
if ($modelData) {
    while ($mrow = mysqli_fetch_assoc($modelData)) {
?>
        <!-- staticBackdrop Modal -->
        <div class="modal fade" id="myModal<?= $mrow['postId'] ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                                                <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header bg-secondary">
                                                                            <h5 class="modal-title text-white" id="staticBackdropLabel">POST DETAILS</h5>
                                                                            <button type="button" class="btn-close text-white" data-bs-dismiss="modal" aria-label="Close">
                                                                            </button>
                                                                        </div>
                                                                        <div class="modal-body">                                                          
    <table class="table table-light table-striped table-bordered table-hover text-center">
        <tr>
            <td><label for="">Title</label></td>
            <td><?= $mrow["title"]; ?></td>
        </tr>
        <tr>
            <td><label for="">Category</label></td>
            <td><?= $mrow["catName"]; ?></td>
        </tr>
        <tr>
            <td><label for="">First Image</label></td>
            <td><img src="<?= $mrow["imageOne"]; ?>" width="250" height="120" /></td>
        </tr>
        <tr>
            <td><label for="">First Description</label></td>
            <td><?= $mrow["disOne"]; ?></td>
        </tr>
        <tr>
            <td><label for="">Second Image</label></td>
            <td><img src="<?= $mrow["imageTwo"]; ?>" width="250" height="120" /></td>
        </tr>
        <tr>
            <td><label for="">Second Description</label></td>
            <td><?= $mrow["disTwo"]; ?></td>
        </tr>
        <tr>
            <td><label for="">Post Type</label></td>
            <td><?php if($mrow["postType"] == 1){
                echo "POST";
            }else{
                echo "SLIDER";
            } ?></td>
        </tr>
        <tr>
            <td><label for="">Post Tags</label></td>
            <td><?= $mrow["tags"]; ?></td>
        </tr>
    </table>
                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <button type="button" class="btn btn-secondary shadow-none text-white" data-bs-dismiss="modal">Close</button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

<?php
    }
}
?>



<?php include "inc/footer.php"; ?>