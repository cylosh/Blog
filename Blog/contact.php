<?php
define("TITLE", 'Contact | Cylosh Blog');
define("HEADER_TITLE", 'Contact Me');
define("HEADER_SUBTITLE", '');
define("MENU_ACTIVE", 'contact');
?><!DOCTYPE html>
<html lang="en">
<head>
<?php include $this->GetTemplate('head'); ?>

</head>
<body>
<?php include $this->GetTemplate('header'); ?>
<?php include $this->GetTemplate('menu'); ?>

	<!-- start:main contact -->
	<div id="main-contact">
		<div class="maps-default">
			<iframe width="100%" height="450" frameborder="0" style="border:0" src="https://www.google.com/maps/embed/v1/place?q=Sibiu%2C%20Rom%C3%A2nia&key=AIzaSyAzT_9I-TQQNKUGa4slWIyedfQ-vAtt7Xw" allowfullscreen></iframe>
		</div>
		<div class="content-contact">
			<div class="container">
				<div class="row">
					<div class="col-lg-8 col-lg-offset-2">
						<div class="text-center	tagline-contact">
							<span>Technical guiding tool making your software idea a reality.</span>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-lg-8 col-md-8 col-sm-7 col-xs-12">
						<div class="form-contact">
							<h3 class="title-form-contact">
								<span>//</span> SEND ME YOUR MESSAGE
							</h3>
							<?php if(isset($this->Alert)) print $this->Alert; ?>
							<form role="form">
								<div class="row">
									<div class="form-group col-md-4">
										<input class="form-control input-lg" placeholder="Name.." <?php if(isset($this->safeOutput['data']['name'])) echo 'value="'.$this->safeOutput['data']['name'].'"'; ?>>
									</div>
									<div class="form-group col-md-4">
										<input class="form-control input-lg" placeholder="Email.." <?php if(isset($this->safeOutput['data']['email'])) echo 'value="'.$this->safeOutput['data']['email'].'"'; ?>>
									</div>
									<div class="form-group col-md-4">
										<input class="form-control input-lg" placeholder="Phone..">
									</div>
									<div class="form-group col-md-12">
										<textarea class="form-control" rows="10" placeholder="Messages.."></textarea>
									</div>
									<div class="form-group col-md-12">
										<button class="btn btn-lg btn-default"><i class="fa fa-envelope"></i> SEND ME</button>
									</div>
								</div>
							</form>
						</div>
					</div>
					<div class="col-lg-4 col-md-4 col-sm-5 col-xs-12">
						<div class="sidebar-contact">
							<h3 class="title-sidebar-contact">
								<span>//</span> MY SERVICE
							</h3>
							<p>Development and management of web applications and sites using technologies such as PHP, SQL, Regex, SOAP,
 HTML5 (Velocity), CSS3 (SCSS/Sass, Bootstrap, Responsive and Adaptive methodologies), JavaScript (jQuery, Underscore.js, Angular.js) and integrating Social Media APIs, Google API, eBay store customization, Bitcoin & Blockchain technology, Web Scraping/Crawlers</p>
						</div>
						<div class="sidebar-contact">
							<h3 class="title-sidebar-contact">
								<span>//</span> MY ADDRESS
							</h3>
							<address>
							  	<strong>Cylosh, Freelancer</strong><br><br>
							  	Tilișca, Sibiu<br>
							  	SB, 550145 România <br>
							  	<abbr title="Phone">P:</abbr> (+40) 734-020-123<br>
							</address>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- end:main contact -->

	<!-- start:footer -->
<?php include $this->GetTemplate('footer'); ?>


	<!-- start:javascript -->
	<script src="cached-assets/js/jquery-1.11.1.min.js,bootstrap.min.js,particles/winter.js,particles/min.js,particles/init.js"></script>
	<!-- end:javascript -->

</body>
</html>