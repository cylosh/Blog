<?php
define("TITLE", 'Register | Cylosh Blog');
define("HEADER_TITLE", 'Sign Up');
define("HEADER_SUBTITLE", 'For Cylosh Services');
?><!DOCTYPE html>
<html>
<?php include dirname(__FILE__).DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'includes'.DIRECTORY_SEPARATOR.'commons'.DIRECTORY_SEPARATOR."head.php"; ?>

<body>

	<?php include dirname(__FILE__).DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'includes'.DIRECTORY_SEPARATOR.'commons'.DIRECTORY_SEPARATOR."header.php"; ?>


	<?php include dirname(__FILE__).DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'includes'.DIRECTORY_SEPARATOR.'commons'.DIRECTORY_SEPARATOR."menu.php"; ?>


	<!-- start:register -->
	<div id="register-alt">
		<div class="container">
			<div class="box-register">
				<form>
					<div class="text-center">
						<h3>Register a new account</h3>
						<small>Already Signed Up? Click <a href="login.html">Sign In</a> to login your account.</small>
					</div>
					<hr>
					<div class="form-group">
						<label>First Name</label>
						<input type="text" class="form-control" placeholder="First Name">
					</div>
					<div class="form-group">
						<label>Last Name</label>
						<input type="text" class="form-control" placeholder="Last Name">
					</div>
					<div class="form-group">
						<label>Email Address</label>
						<input type="email" class="form-control" placeholder="Email">
					</div>
					<div class="form-group row">
						<div class="col-md-6">
							<label>Password</label>
							<input class="form-control" type="password" placeholder="Password">
						</div>
						<div class="col-md-6">
							<label>Password Confirmation</label>
							<input class="form-control" type="password" placeholder="Password">
						</div>
					</div>
					<hr>
					<div class="checkbox">
					    <label>
					      	<input type="checkbox"> I read <a href="#">Terms and Conditions</a>
					    </label>
					</div>
					<div class="form-group">
						<button class="btn btn-warning btn-block">LOGIN</button>
					</div>
				</form>
			</div>
		</div>
	</div>
	<!-- end:register -->

	<!-- start:footer -->
	<?php include dirname(__FILE__).DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'includes'.DIRECTORY_SEPARATOR.'commons'.DIRECTORY_SEPARATOR."footer.php"; ?>


	<!-- start:javascript -->
	<script src="assets/UI/jquery-1.11.1.min.js"></script>
	<script src="assets/UI/bootstrap.min.js"></script>
	<script src="assets/UI/particles/min.js"></script>
	<script src="assets/UI/particles/init.js"></script>
	<script src="assets/UI/init.js"></script>
	<!-- end:javascript -->

</body>
</html>