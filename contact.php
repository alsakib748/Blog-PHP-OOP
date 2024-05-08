<?php
include "inc/header.php";
include_once 'classes/SiteOption.php';
$sop = new SiteOption();

if ($_SERVER['REQUEST_METHOD'] == "POST") {
  $addContact = $sop->addContact($_POST);
}
?>
<!-- END header -->


<section class="site-section">
  <div class="container">
    <div class="row mb-4">
      <div class="col-md-6">
        <h1>Contact Me</h1>
      </div>
    </div>
    
    <div class="row blog-entries">
      <div class="col-md-12 col-lg-8 main-content">
      <span>
      <?php
      if (isset($addContact)) {
      ?>
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
          <strong><?php echo $addContact; ?></strong>
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
      <?php
      }
      ?>
    </span>
        <form action="#" method="post">
          <div class="row">
            <div class="col-md-12 form-group">
              <label for="name">Name</label>
              <input type="text" id="name" name="username" class="form-control ">
            </div>
            <div class="col-md-12 form-group">
              <label for="phone">Phone</label>
              <input type="text" id="phone" name="phone" class="form-control ">
            </div>
            <div class="col-md-12 form-group">
              <label for="email">Email</label>
              <input type="email" id="email" name="email" class="form-control ">
            </div>
          </div>
          <div class="row">
            <div class="col-md-12 form-group">
              <label for="message">Write Message</label>
              <textarea name="message" id="message" name="message" class="form-control " cols="30" rows="8"></textarea>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6 form-group">
              <input type="submit" value="Send Message" class="btn btn-primary">
            </div>
          </div>
        </form>


      </div>

      <!-- END main-content -->

      <?php include "inc/sidebar.php"; ?>
      <!-- END sidebar -->

    </div>
  </div>
</section>

<!-- Footer Include -->
<?php include "inc/footer.php"; ?>