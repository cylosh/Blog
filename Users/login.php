<?php
define("TITLE", 'Login | Cylosh Blog');
define("HEADER_TITLE", 'Login to');
define("HEADER_SUBTITLE", 'Cylosh Services');
?><!DOCTYPE html>
<html>
<head>
<?php include $this->GetTemplate('head'); ?>

</head>
<body>

	<!-- start:header -->
	<?php include $this->GetTemplate('header'); ?>

	<!-- end:header -->

	<!-- start:navbar -->
	<?php include $this->GetTemplate('menu'); ?>


	<!-- end:navbar -->

	<!-- start:login -->
	<div id="login-alt">
		<div class="container">
			<div class="box-login-alt">
				<form>
					<div class="text-center">
						<h3>Login to your account</h3>
					</div>
					<hr>
					<div class="form-group">
						<div class="input-group">
						  	<span class="input-group-addon"><i class="fa fa-user"></i></span>
						  	<input type="text" class="form-control" placeholder="Username">
						</div>
					</div>
					<div class="form-group">
						<div class="input-group">
						  	<span class="input-group-addon"><i class="fa fa-lock"></i></span>
						  	<input type="text" class="form-control" placeholder="Password">
						</div>
					</div>
					<div class="checkbox">
					    <label>
					      	<input type="checkbox"> Stay Sign in
					    </label>
					</div>
					<div class="form-group">
						<button class="btn btn-warning btn-block">LOGIN</button>
					</div>
					<hr>
					<h4>Forget your Password ?</h4>
					<p>no worries, <a href="#">click here</a> to reset your password.</p>
				</form>
			</div>
		</div>
	</div>
	<!-- end:login -->

	<!-- start:footer bottom -->
	<?php include $this->GetTemplate('footer'); ?>


	<!-- end:footer bottom -->

	<!-- start:javascript -->
	<script src="cached-assets/js/jquery-1.11.1.min.js,bootstrap.min.js,particles/winter.js,particles/min.js,particles/init.js,init.js"></script>
	<!-- end:javascript -->

</body>
</html>