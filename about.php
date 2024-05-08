<?php

include "inc/header.php";
include_once 'classes/SiteOption.php';
$sop = new SiteOption();
include_once 'helpers/Format.php';
$fr = new Format();
include_once 'classes/Post.php';
$post = new Post();

?>
<!-- END header -->


<section class="site-section pt-5">
  <div class="container">

    <div class="row blog-entries">
      <div class="col-md-12 col-lg-8 main-content">

        <div class="row">
          <?php
          $allAbout = $sop->aboutInfo();
          if ($allAbout) {
            while ($arow = mysqli_fetch_assoc($allAbout)) {
          ?>
              <div class="col-md-12">
                <h2 class="mb-4">Hi There! I'm <?= $arow['username']; ?></h2>
                <p class="mb-5"><img src="admin/<?= $arow['image']; ?>" alt="Image placeholder" class="img-fluid"></p>
                <p><?= $arow['userDetails']; ?></p>
              </div>
          <?php
            }
          }
          ?>

        </div>

        <div class="row mb-5 mt-5">
          <div class="col-md-12 mb-5">
            <h2>My Latest Posts</h2>
          </div>
          <div class="col-md-12">
            <?php
            $limit = 2;
            if(isset($_GET['page'])){
              $page = $_GET['page'];
            }else{
              $page = 1;
            }
            $offset = ($page - 1) * $limit;
            $latestPost = $sop->latestPost($offset, $limit);
            if ($latestPost) {
              while ($row = mysqli_fetch_assoc($latestPost)) {
            ?>
                <div class="post-entry-horzontal">
                  <a href="blog-single.php">
                    <div class="image" style="background-image: url(admin/<?= $row['imageOne']; ?>);"></div>
                    <span class="text">
                      <div class="post-meta">
                        <span class="author mr-2"><img src="admin/<?= $row['image'] ?>" alt="Colorlib"> <?= $row['username']; ?></span>&bullet;
                        <span class="mr-2"><?= $fr->formatdate($row['created_at']); ?> </span> &bullet;
                        <span class="ml-2"><span class="fa fa-comments"></span> 3</span>
                      </div>
                      <h2><?= $row['title']; ?></h2>
                    </span>
                  </a>
                </div>
                <!-- END post -->
            <?php
              }
            }
            ?>


          </div>
        </div>

        <div class="row">
          <div class="col-md-12 text-center">
            <nav aria-label="Page navigation" class="text-center">
                  <?php
                  $num_page = $post->numPost();
                  if ($num_page) {
                    $total_record = mysqli_num_rows($num_page);
                    $total_page = ceil($total_record / $limit);
                  ?>
                    <ul class="pagination">
                      <?php 
                        if($page > 1){
                      ?>
                        <li class="page-item"><a class="page-link" href="about.php?page=<?= $page - 1; ?>">&lt;</a></li>
                      <?php
                        }
                      ?>

                      <?php 
                        for($i=1;$i <= $total_page; $i++){
                          if($i == $page){
                            $active = 'active';
                          }else{
                            $active = '';
                          }
                      ?>
                          <li class="page-item <?= $active; ?>"><a class="page-link" href="about.php?page=<?= $i ?>"><?= $i ?></a></li>
                      <?php
                        }
                      ?>

                      <?php 
                        if($total_page > $page){
                      ?>    
                          <li class="page-item"><a class="page-link" href="about.php?page=<?= $page + 1; ?>">&gt;</a></li>
                      <?php
                        }
                      ?>
                      
                    </ul>
                  <?php
                  }
                  ?>
            </nav>
          </div>
        </div>



      </div>

      <!-- END main-content -->

      <?php include "inc/sidebar.php"; ?>
      <!-- END sidebar -->

    </div>
  </div>
</section>

<!-- Footer Include -->
<?php include "inc/footer.php"; ?>