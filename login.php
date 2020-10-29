<?php
include 'lib/header.php';
include 'functions/alert.php';

if (isset($_SESSION['user_id'])) { //check is user is logged in
  header('location: dashboard.php'); //redirect to dashboard
}

?>

<div class="row">
	<div class="col-md-4"></div>
	<div class="col-md-4">
	<div class="p-4">
		<center><h1 class="panel-title">Login</h1></center>
		<p><?php  print_alert(); ?></p>
			<form method="POST" action="process_login.php">
				<div class="form-group">
					<label for="username">Email</label>
					<input class="form-control" name="email" placeholder="Email" type="email" required="required" >
				</div>
				<div class="form-group">
					<label for="password">Password</label>
					<input class="form-control" name="password" placeholder="Password" type="password" required="required" >
				</div>
				<div class="form-group">
					<button class="btn btn-block btn-primary" name="login">Login</button>
				</div>
			</form>
		</div>
	</div>
</div>	

<?php include('lib/footer.php'); ?>

