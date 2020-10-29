<?php 
include_once('lib/header.php');
require('functions/user.php');

if (! isset($_SESSION['user_id'])) { //check if user is logged in
    $_SESSION['info'] =  "you must login to access private file"; 
    header('location: login.php'); //redirect to login
}

?>

<div class="pricing-header px-3 py-3 pt-md-5 pb-md-4 mx-auto text-center">
        <h5>Private Files</h5>
        <?php
            $rows = get_private_files();
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
            <p>No private file available</p>
        <?php } ?>
    </div>



<?php include_once('lib/footer.php'); ?>