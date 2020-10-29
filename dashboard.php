<?php 
require('lib/header.php');
require 'functions/alert.php';
require('functions/user.php');

if (! isset($_SESSION['user_id'])) { //check if user is logged in
    header('location: login.php');   //redirect to login page
}

?>

<div class="header px-3 py-3 pt-md-5 pb-md-4 mx-auto text-center" style="background-color: #87ceeb;">
  <h1 class="display-5">Dashboard</h1>
    <p class="lead"> Welcome <?php echo $_SESSION['fullname']?></p>
    </p> <a class="btn btn-bg btn-primary" href="private.php">Private Files ></a> </p>
</div>

<div class="container">
	<div class="row">
    <p><?php  print_alert(); ?></p>
      <div class="card shadow p-4 m-2 col-md-12">
        <div class="card-header py-3">
          <button class="btn btn-success" data-toggle="modal" data-target="#form_modal">Add File</button>
        </div>
        <div class="card-body">
          <h5>My Files</h5>
        <?php
          $rows = get_user_files($_SESSION['email']);
          if ($rows) {
        ?>
        <table class="table table-bordered table-striped table-hover">
          <thead class="thead-dark ">
            <tr>
              <th scope="col">Name</th>
              <th scope="col">Size</th>
              <th scope="col">Type</th>
              <th scope="col">Uploaded By</th>
              <th scope="col">Date Uploaded</th>
              <th scope="col">Total Download</th>
              <th scope="col">Category</th>
              <th scope="col"></th>
            </tr>
          </thead>
            <tbody>
              <?php echo $rows; ?>
            </tbody>
            </table>
              <?php } else { ?>
              <p>You have no file</p>
             <?php } ?>
        </div>
      </div>

		<div class="modal fade" id="form_modal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <form method="POST" action="save_file.php" enctype="multipart/form-data">  
          <div class="modal-header">
            <h4 class="modal-title">Upload File</h4>
          </div>
          <div class="modal-body">
            <div class="col-md-3"></div>
            <div class="col-md-9">
              <div class="">
                <label>Select File</label>
                <input type="file" name="file" class="form-control" required="required"/> <p style="color: red">maximum: 2MB</p>
              </div>
              <div class="form-group">
                <label>File category</label>
               <select name="category" class="form-control" required="required">
                  <option value="public">Public</option>
                  <option value="private">Private</option>
               </select>
              </div>
             
            </div>
          </div>
          <div style="clear:both;"></div>
          <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            <button name="save" class="btn btn-success" >Upload</button>
          </div>
        </form>
      </div>
    </div>
  </div>
	</div>
	
</div>
</div>


<?php include_once('lib/footer.php'); ?>