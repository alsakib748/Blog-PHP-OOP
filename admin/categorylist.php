<?php include "inc/header.php"; ?>


<!-- Sidebar Include -->
<?php include "inc/sidebar.php"; ?>

<?php
include "../classes/Category.php";
$ct = new Category();

$allCat = $ct->AllCategory();

if(isset($_GET["delCat"])){
    $id = base64_decode($_GET["delCat"]);
    $deleteCat = $ct->DeleteCategory($id);
}

?>

<?php 

if(!isset($_GET["id"])){
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
                        if (isset($deleteCat)) {
                        ?>
                            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                <strong><?php echo $deleteCat; ?></strong>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        <?php
                        }
                        ?>
                    </span>
                                <div class="card shadow">
                                    <div class="card-header bg-secondary">
                                        <div class="card-title fs-5 text-white">CATEGORY LIST</div>
                                    </div>
                                    <div class="card-body">
        
                                        <table id="datatable" class="table table-bordered dt-responsive nowrap text-center" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                            <thead>
                                            <tr>
                                                <th>SL</th>
                                                <th>Department Name</th>
                                                <th>Action</th>
                                            </tr>
                                            </thead>
        
                                            <tbody>
                                            <?php
                                            if($allCat){
                                                $i = 1;
                                                while($row = mysqli_fetch_assoc($allCat)){
                                            ?>
                                            <tr>
                                                <td><?php echo $i; ?></td>
                                                <td><?php echo $row["catName"]; ?></td>
                                                <td>
                                                    <a href="catEdit.php?editId=<?php echo base64_encode($row["catId"]); ?>" class="btn btn-sm btn-success ">Edit</a>
                                                    <a href="?delCat=<?= base64_encode($row["catId"]); ?>" onclick = "return confirm('Are you sure to delete - <?php echo $row['catName']; ?>')"  class="btn btn-sm btn-danger ">Delete</a>
                                                </td>
                                            </tr>
                                            <?php
                                                $i++;
                                                } 
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



<?php include "inc/footer.php"; ?>