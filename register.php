<?php
include 'lib/header.php';
include 'functions/alert.php';

if (isset($_SESSION['user_id'])) {
  header('location: dashboard.php');
}

?>

<div class="row">
<div class="col-md-4"></div>
<div class="col-md-4">
	<div class="p-4">
		<center><h1 class="panel-title">Register</h1></center>
			<p><?php  print_alert(); ?></p>
			<form method="POST" action="process_register.php">
				<div class="form-group">
					<label for="username">Fullname</label>
					<input class="form-control" name="fullname" placeholder="Fullname" type="text" required="required" >
				</div>
				<div class="form-group">
					<label for="username">Email</label>
					<input class="form-control" name="email" placeholder="Email" type="email" required="required" >
				</div>
				<div class="form-group">
					<label for="password">Password</label>
					<input class="form-control" name="password" placeholder="Password" type="password" required="required" >
				</div>
				<div class="form-group">
					<label for="password">Confirm Password</label>
					<input class="form-control" name="confirm_password" placeholder="Confirm Password" type="password" required="required" >
				</div>
				<div class="form-group">
					<button class="btn btn-block btn-primary" type="submit">Register</button>
				</div>
				<p>Already have an account? <a href="login.php">Login</a></p>
			</form>		
		</div>
	</div>
</div>	

<?php include('lib/footer.php'); ?>

