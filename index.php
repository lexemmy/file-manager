<?php 
require('lib/header.php');
require('functions/alert.php');
require('functions/user.php');
?>

<div class="pricing-header px-3 py-3 pt-md-5 pb-md-4 mx-auto text-center">
    <h1 class="display-6"> File Manager.</h1>
    <p class="lead">Supported file extentions are: jpg, png, gif, jpeg, mp4, mpg, mpeg, mp3, doc, docx, pdf and txt</p>
    <p class="lead">You must <a href="login.php">login</a> to access <a href="private.php">private files</a></p>
    <p>
        <a class="btn btn-bg btn-outline-secondary" href="login.php">Login</a>
        <a class="btn btn-bg btn-outline-primary" href="register.php">Register</a>            
    </p>
    <h5>Public Files</h5>
    <p><?php  print_alert(); ?></p>

    <?php
        $rows = get_public_files();
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
                <th scope="col"></th>
            </tr>
        </thead>
        <tbody>
            <?php echo $rows; ?>
        </tbody>
    </table>
    <?php } else { ?>
            <p>No file available</p>
    <?php } ?>
    </div>

<?php include_once('lib/footer.php'); ?>