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
	<footer>
		<div class="container">
			<div class="row">
				<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
					<div class="widget-footer">
						<h4 class="title-widget-footer">
							ABOUT
						</h4>
						<p class="content-footer">
							Kagum is a Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
						</p>

						<p class="content-footer">
							Laboris nisi ut aliquip ex ea commodo consequat.
						</p>
						<div class="sosmed-footer">
							<a href="https://twitter.com/Cylosh"><i class="fa fa-twitter" data-toggle="tooltip" data-placement="bottom" title="Twitter"></i></a>
							<a href="http://stackoverflow.com/users/2039952/cylosh?tab=profile"><i class="fa fa-github" data-toggle="tooltip" data-placement="bottom" title="Github"></i></a>
							<a href="https://github.com/cylosh"><i class="fa fa-stack-overflow" data-toggle="tooltip" data-placement="bottom" title="StackOverflow"></i></a>
							<a href="https://www.linkedin.com/in/cylosh"><i class="fa fa-linkedin" data-toggle="tooltip" data-placement="bottom" title="Linkedin"></i></a>
							<a href="skype:cylosh?call"><i class="fa fa-skype" data-toggle="tooltip" data-placement="bottom" title="Skype"></i></a>
						</div>
					</div>
				</div>
				<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
					<div class="widget-footer">
						<h4 class="title-widget-footer">SUBCRIBE NEWSLETTER</h4>
						<p class="content-footer">
							Excepteur culpa qui officia deserunt mollit anim id est laborum.
						</p>
						<form role="form">
							<div class="form-group">
								<div class="input-group">
								  	<span class="input-group-addon"><i class="fa fa-envelope"></i></span>
								  	<input type="text" class="form-control" placeholder="Username">
								</div>
							</div>
							<div class="form-group">
								<a href="#" class="btn btn-warning">REGISTER</a>
							</div>
						</form>
					</div>
				</div>
				<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
					<div class="widget-footer">
						<h4 class="title-widget-footer">TAG CLOUD</h4>
						<div class="content-widget-footer">
							<a href="#" class="label label-default">Blog</a>
							<a href="#" class="label label-default">Lanscape</a>
							<a href="#" class="label label-default">Pemandangan</a>
							<a href="#" class="label label-default">Alam</a>
							<a href="#" class="label label-default">Nuansa</a>
							<a href="#" class="label label-default">Cool</a>
							<a href="#" class="label label-default">Templates</a>
							<a href="#" class="label label-default">Masa kini</a>
							<a href="#" class="label label-default">Responsive</a>
							<a href="#" class="label label-default">Indah</a>
							<a href="#" class="label label-default">Menawan</a>
							<a href="#" class="label label-default">Awesome</a>
							<a href="#" class="label label-default">Mengagumkan</a>
						</div>
					</div>
				</div>
				<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
					<div class="widget-footer">
						<h4 class="title-widget-footer">FLICKR FEED</h4>
						<div class="flickr">
							<a href="#">
								<div class="thumbnail">
									<img src="assets/images/content/thumbnail1.jpg" class="img-responsive">
								</div>
							</a>
							<a href="#">
								<div class="thumbnail">
									<img src="assets/images/content/thumbnail4.jpg" class="img-responsive">
								</div>
							</a>
							<a href="#">
								<div class="thumbnail">
									<img src="assets/images/content/thumbnail5.jpg" class="img-responsive">
								</div>
							</a>
							<a href="#">
								<div class="thumbnail">
									<img src="assets/images/content/thumbnail6.jpg" class="img-responsive">
								</div>
							</a>
							<a href="#">
								<div class="thumbnail">
									<img src="assets/images/content/thumbnail7.jpg" class="img-responsive">
								</div>
							</a>
							<a href="#">
								<div class="thumbnail">
									<img src="assets/images/content/thumbnail8.jpg" class="img-responsive">
								</div>
							</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</footer>
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