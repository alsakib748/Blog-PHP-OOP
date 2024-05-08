<?php 
include "inc/header.php"; 

include "inc/sidebar.php"; 

include "../classes/SiteOption.php";
$sop = new SiteOption();

include_once '../helpers/Format.php';
$fr = new Format();

// delete post
if (isset($_GET["delCnt"])) {
    $id = base64_decode($_GET["delCnt"]);
    $deletePost = $sop->deleteContact($id);
}

// $allCat = $pt->AllCategory();

// if(isset($_GET["delCat"])){
//     $id = base64_decode($_GET["delCat"]);
//     $deleteCat = $ct->DeleteCategory($id);
// }

?>

<?php

if (!isset($_GET["id"])) {
    echo "<meta http-equiv='refresh' content='0;URL=?id=ahr'/>";
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
                        if (isset($deletePost)) {
                        ?>
                            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                <strong><?php echo $deletePost; ?></strong>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        <?php
                        }
                        ?>
                    </span>
                    <div class="card shadow">
                        <div class="card-header bg-secondary">
                            <div class="card-title fs-5 text-white">ALL POST</div>
                        </div>
                        <div class="card-body">

                            <table id="datatable" class="table table-bordered dt-responsive nowrap text-center" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                    <tr>
                                        <th>SL</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>Message</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php
                                    $allContact = $sop->allContact();
                                    if ($allContact && mysqli_num_rows($allContact) > 0) {
                                        $i = 1;
                                        while ($row = mysqli_fetch_assoc($allContact)) {
                                    ?>
                                            <tr>
                                                <td><?php echo $i; ?></td>
                                                <td><?php echo $row["name"]; ?></td>
                                                <td><?php echo $row["email"]; ?></td>
                                                <td><?php echo $row["phone"]; ?></td>
                                                <td><?php echo $row["message"]; ?></td>
                                                <td>
                                                    <a href="?delCnt=<?= base64_encode($row["contactId"]); ?>" onclick="return confirm('Are You Sure To Delete ?')" class="btn btn-sm btn-danger waves-effect waves-light"><i class="fas fa-trash"></i> </a>
                                                    <a href="#" class="btn btn-sm btn-info waves-effect waves-light" data-bs-toggle="modal" data-bs-target="#myModal<?= $row['contactId'] ?>"><i class="fas fa-eye"></i> </a>
                                                </td>
                                            </tr>
                                    <?php
                                            $i++;
                                        }
                                    } else {
                                        echo "<h4 class='alert alert-warning text-center'>No Message Found!</h4>";
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
$modelData = $sop->allContact();
if ($modelData) {
    while ($mrow = mysqli_fetch_assoc($modelData)) {
?>
        <!-- staticBackdrop Modal -->
        <div class="modal fade" id="myModal<?= $mrow['contactId'] ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-secondary">
                        <h3 class="modal-title text-white">Contact Us Details</h3>
                    </div>
                    <div class="modal-body">
                        <table class="table table-light table-striped table-bordered table-hover text-center">
                            <tr>
                                <td><label for="">Name</label></td>
                                <td><?= $mrow["name"]; ?></td>
                            </tr>
                            <tr>
                                <td><label for="">Email</label></td>
                                <td><?= $mrow["email"]; ?></td>
                            </tr>
                            <tr>
                                <td><label for="">Phone</label></td>
                                <td><?= $mrow["phone"]; ?></td>
                            </tr>
                            <tr>
                                <td><label for="">Message</label></td>
                                <td><?= $mrow["message"]; ?></td>
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