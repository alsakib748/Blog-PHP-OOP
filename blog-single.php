<?php
include_once "inc/header.php";
include_once "classes/Post.php";
$post = new Post();
include_once "helpers/Format.php";
$fr = new Format();
include_once "classes/Comment.php";
$cmt = new Comment();

if (isset($_GET["singleId"])) {
  $postId = base64_decode($_GET["singleId"]);
}

if ($_SERVER['REQUEST_METHOD'] == "POST") {
  $comment = $cmt->addComment($_POST);
}
?>
<!-- END header -->

<section class="site-section py-lg">
  <div class="container">

    <div class="row blog-entries element-animate">
      <?php
      $getPost = $post->singlePost($postId);
      if ($getPost) {
        while ($row = mysqli_fetch_assoc($getPost)) {
      ?>
          <div class="col-md-12 col-lg-8 main-content">
            <img src="admin/<?= $row["imageOne"]; ?>" alt="Image" class="img-fluid mb-5">
            <div class="post-meta">
              <span class="author mr-2"><img src="admin/<?= $row["image"]; ?>" alt="Colorlib" class="mr-2"> <?= $row['username']; ?></span>&bullet;
              <span class="mr-2"><?= $fr->formatdate($row["created_at"]); ?> </span> &bullet;
              <span class="ml-2"><span class="fa fa-comments"></span> 3</span>
            </div>
            <h1 class="mb-4"><?= $row["title"]; ?></h1>
            <a class="category mb-5" href="#"><?= $row["catName"]; ?></a>

            <div class="post-content-body">
              <p><?= $row["disOne"]; ?></p>

              <div class="row mb-5">
                <div class="col-md-12 mb-4">
                  <img src="admin/<?= $row["imageTwo"]; ?>" alt="Image placeholder" class="img-fluid">
                </div>
              </div>
              <p><?= $row["disTwo"]; ?></p>

            </div>

            <div class="pt-5">
              <p>Categories: <a href="#"><?= $row["catName"]; ?></a> Tags: <a href="#"><?= $row["tags"]; ?></a></p>
            </div>

            <div class="pt-5">
              <?php
              $pid = $row['postId'];
              $allComment = $cmt->allComment($pid);
              if ($allComment) {
                $num_rows = mysqli_num_rows($allComment);
                echo "<h3 class='mb-5'>$num_rows Comments</h3>";
                while ($crow = mysqli_fetch_assoc($allComment)) {
              ?>
                  <ul class="comment-list">

                    <li class="comment">
                      <div class="vcard">
                        <img src="images/person_1.jpg" alt="Image placeholder">
                      </div>
                      <div class="comment-body">
                        <h3><?= $crow["name"]; ?></h3>
                        <div class="meta"><?= $fr->formatdate($row["created_at"]); ?></div>
                        <p><?= $crow["message"] ?></p>
                        <!-- <p><a href="#" class="reply rounded">Reply</a></p> -->
                      </div>
                      <?php
                      if ($crow['admin_reply']) {
                      ?>
                        <ul class="children">
                          <li class="comment">
                            <div class="vcard">
                              <img src="admin/<?= $crow["image"]; ?>" alt="Image placeholder">
                            </div>
                            <div class="comment-body">
                              <h3><?= $crow['username']; ?></h3>
                              <div class="meta"><?= $crow['update_date']; ?></div>
                              <p><?= $crow["admin_reply"]; ?></p>
                              <p><a href="#" class="reply rounded">Reply</a></p>
                            </div>
                          </li>
                        </ul>
                      <?php
                      }
                      ?>


                    </li>

                  </ul>
                  <!-- END comment-list -->
              <?php
                }
              }
              ?>


              <div class="comment-form-wrap pt-5">
                <h3 class="mb-5">Leave a comment</h3>
                <span>
                  <?php
                  if (isset($comment)) {
                  ?>
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                      <strong><?php echo $comment; ?></strong>
                      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                  <?php
                  }
                  ?>
                </span>
                <form action="#" method="POST" class="p-5 bg-light">
                  <input type="hidden" name="userId" class="form-control" value="<?= $row['userId']; ?>" />
                  <input type="hidden" name="postId" class="form-control" value="<?= $row['postId']; ?>" />
                  <div class="form-group">
                    <label for="name">Name *</label>
                    <input type="text" name="name" class="form-control" id="name">
                  </div>
                  <div class="form-group">
                    <label for="email">Email *</label>
                    <input type="email" name="email" class="form-control" id="email">
                  </div>
                  <div class="form-group">
                    <label for="website">Website</label>
                    <input type="url" name="website" class="form-control" id="website">
                  </div>

                  <div class="form-group">
                    <label for="message">Message</label>
                    <textarea name="message" id="message" cols="30" rows="10" class="form-control"></textarea>
                  </div>
                  <div class="form-group">
                    <input type="submit" value="Post Comment" class="btn btn-primary" name="submit">
                  </div>

                </form>
              </div>
            </div>

          </div>



          <!-- END main-content -->

          <?php include "inc/sidebar.php"; ?>
          <!-- END sidebar -->

    </div>
  </div>
</section>

<section class="py-5">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <h2 class="mb-3 ">Related Post</h2>
      </div>
    </div>
    <div class="row">
      <?php
          $rel_post = $post->relatedPost($row['catId']);
          if ($rel_post) {
            while ($rp = mysqli_fetch_assoc($rel_post)) {
      ?>
          <div class="col-md-6 col-lg-4">
            <a href="blog-single.php?singleId=<?= base64_encode($rp["postId"]); ?>" class="a-block sm d-flex align-items-center height-md" style="background-image: url(admin/<?= $rp['imageOne'] ?>); ">
              <div class="text">
                <div class="post-meta">
                  <span class="category"><?= $rp['catName'] ?></span>
                  <span class="mr-2"><?= $fr->formatdate($rp['created_at']) ?> </span> &bullet;
                  <span class="ml-2"><span class="fa fa-comments"></span> 3</span>
                </div>
                <h3><?= $rp['title'] ?></h3>
              </div>
            </a>
          </div>
      <?php
            }
          }
      ?>



    </div>
  </div>

<?php
        }
      }
?>

</section>
<!-- END section -->

<!-- Footer Include -->
<?php include "inc/footer.php"; ?>