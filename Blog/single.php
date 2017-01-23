<?php
define("TITLE", 'Blog Title | Cylosh Blog');
define("HEADER_TITLE", 'The Cylosh Blog');
define("HEADER_SUBTITLE", 'Unfolding the Article');
?><!DOCTYPE html>
<html lang="en">
<?php include dirname(__FILE__).DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'includes'.DIRECTORY_SEPARATOR.'commons'.DIRECTORY_SEPARATOR."head.php"; ?>
<body>
<?php include dirname(__FILE__).DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'includes'.DIRECTORY_SEPARATOR.'commons'.DIRECTORY_SEPARATOR."header.php"; ?>
<article id="scrolltojs"></article> <!-- hack to check its an blog article that needs to automatically scroll to the content -->
<?php include dirname(__FILE__).DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'includes'.DIRECTORY_SEPARATOR.'commons'.DIRECTORY_SEPARATOR."menu.php"; ?>


	<!-- start:single blog -->
	<div id="single-blog">
		<div class="container">
			<div class="row">
				<div class="col-lg-8 col-md-8">
					<!-- start:single content -->
					<div id="main-single-content">
						<img src="assets/images/content/thumbnail8.jpg" class="img-responsive">
						<div class="content-single">
							<h2>Niki Postingan Sing Kepisan Njeh, Perdana Ngoten</h2>
							<div class="tag">
								<p>	
									<span><i class="fa fa-user"></i> <a href="#">Admin</a></span> 
									<i class="fa fa-circle"></i> 
									<span><i class="fa fa-calendar"></i> <a href="#">Juni, 30 2014</a></span>
									<i class="fa fa-circle"></i>
									<span><i class="fa fa-folder"></i> <a href="#">Uncategories</a>, <a href="#">Lanscape</a></span>
									<i class="fa fa-circle"></i>
									<span><i class="fa fa-tag"></i> <a href="#">Acesories</a>, <a href="#">Furniture</a></span>
								</p>
							</div>
							<div class="hr-single"></div>
							<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas euismod diam at commodo sagittis. Nam id molestie velit. Nunc id nisl tristique, dapibus tellus quis, dictum metus. Pellentesque id imperdiet est. Maecenas adipiscing dui at enim placerat hendrerit. Curabitur pulvinar fermentum ante id bibendum. Etiam est sem, pharetra in luctus quis, tempor facilisis urna. Etiam ullamcorper dictum elit sit amet hendrerit. Donec porta mauris a est rhoncus pharetra.</p>
							<p>Mauris pellentesque sem sem, sit amet faucibus purus venenatis id. Ut vitae risus eleifend, tristique elit vitae, rhoncus sapien. Nunc ipsum lacus, tincidunt et cursus sit amet, gravida auctor risus. Praesent quam tellus, fringilla in ante eu, euismod euismod orci. Aenean a tincidunt leo, lobortis vulputate neque. Pellentesque faucibus dignissim est consequat ultrices. Quisque elementum dolor vel posuere auctor. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Mauris dictum magna quis dolor imperdiet vestibulum. Proin ultricies malesuada diam id gravida. Aenean commodo aliquet gravida. Donec bibendum non libero id tincidunt.</p>
							<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas euismod diam at commodo sagittis. Nam id molestie velit. Nunc id nisl tristique, dapibus tellus quis, dictum metus. Pellentesque id imperdiet est. Maecenas adipiscing dui at enim placerat hendrerit. Curabitur pulvinar fermentum ante id bibendum. Etiam est sem, pharetra in luctus quis, tempor facilisis urna. Etiam ullamcorper dictum elit sit amet hendrerit. Donec porta mauris a est rhoncus pharetra.</p>
							<p>Mauris pellentesque sem sem, sit amet faucibus purus venenatis id. Ut vitae risus eleifend, tristique elit vitae, rhoncus sapien. Nunc ipsum lacus, tincidunt et cursus sit amet, gravida auctor risus. Praesent quam tellus, fringilla in ante eu, euismod euismod orci. Aenean a tincidunt leo, lobortis vulputate neque. Pellentesque faucibus dignissim est consequat ultrices. Quisque elementum dolor vel posuere auctor. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Mauris dictum magna quis dolor imperdiet vestibulum. Proin ultricies malesuada diam id gravida. Aenean commodo aliquet gravida. Donec bibendum non libero id tincidunt.</p>
							<div class="hr-single"></div>
							<!-- start:comments -->
							<div id="comments-list">
								<!-- start:comments list -->
								<div class="comment">
									<h3>Comments List</h3>
									<ul class="comments">
		                                <li>
		                                    <img src="assets/images/user/user.jpg">
		                                    <div class="post-comments">
		                                        <p class="meta">Juni 30, 2014 <a href="#">Admin</a> says : <i class="pull-right"><a href="#"><small class="btn btn-xs btn-default">Reply</small></a></i></p>
		                                        <p>
		                                            Lorem ipsum dolor sit amet, consectetur adipiscing elit.
		                                            Etiam a sapien odio, sit amet
		                                        </p>
		                                    </div>
		                                </li>
		                                <li>
		                                    <img src="assets/images/user/user.jpg">
		                                    <div class="post-comments">
		                                        <p class="meta">July 1, 2014 <a href="#">Admin</a> says : <i class="pull-right"><a href="#"><small class="btn btn-xs btn-default">Reply</small></a></i></p>
		                                        <p>
		                                            Lorem ipsum dolor sit amet, consectetur adipiscing elit.
		                                            Etiam a sapien odio, sit amet
		                                        </p>
		                                    </div>
		                                    
		                                    <ul class="comments hidden-xs list-unstyled">
		                                        <li class="clearfix">
		                                            <img src="assets/images/user/user.jpg" class="avatar" alt="danish personal blog and magazine template">
		                                            <div class="post-comments">
		                                                <p class="meta">July 2, 2014 <a href="#">Admin</a> says : <i class="pull-right"><a href="#"><small class="btn btn-xs btn-default">Reply</small></a></i></p>
		                                                <p>
		                                                    Lorem ipsum dolor sit amet, consectetur adipiscing elit.
		                                                    Etiam a sapien odio, sit amet
		                                                </p>
		                                            </div>
		                                            
		                                            <ul class="comments list-unstyled">
		                                                <li class="clearfix">
		                                                    <img src="assets/images/user/user.jpg" class="avatar" alt="danish personal blog and magazine template">
		                                                    <div class="post-comments">
		                                                        <p class="meta">July 3, 2014 <a href="#">Admin</a> says : <i class="pull-right"><a href="#"><small class="btn btn-xs btn-default">Reply</small></a></i></p>
		                                                        <p>
		                                                            Lorem ipsum dolor sit amet, consectetur adipiscing elit.
		                                                            Etiam a sapien odio, sit amet
		                                                        </p>
		                                                    </div>
		                                                </li>
		                                            </ul>
		                                        </li>
		                                    </ul>
		                                </li>
		                                <li class="clearfix">
		                                    <img src="assets/images/user/user.jpg" class="avatar" alt="danish personal blog and magazine template">
		                                    <div class="post-comments">
		                                        <p class="meta">July 5, 2014 <a href="#">Admin</a> says : <i class="pull-right"><a href="#"><small class="btn btn-xs btn-default">Reply</small></a></i></p>
		                                        <p>
		                                            Lorem ipsum dolor sit amet, consectetur adipiscing elit.
		                                            Etiam a sapien odio, sit amet
		                                        </p>
		                                    </div>
		                                </li>
		                            </ul>
								</div>
								<!-- end:comments list -->
								<!-- start:form comment -->
								<div class="form-comment">
									<h3>Form Comments</h3>
									<form role="form">
										<div class="row">
											<div class="form-group col-md-4">
												<input class="form-control input-lg" placeholder="Name..">
											</div>
											<div class="form-group col-md-4">
												<input class="form-control input-lg" placeholder="Email..">
											</div>
											<div class="form-group col-md-4">
												<input class="form-control input-lg" placeholder="Url..">
											</div>
											<div class="form-group col-md-12">
												<textarea class="form-control" rows="10" placeholder="Messages.."></textarea>
											</div>
											<div class="form-group col-md-12">
												<button class="btn btn-lg btn-default btn-block">SUBMIT</button>
											</div>
										</div>
									</form>
								</div>
								<!-- end:form comment -->
							</div>
							<!-- end:comments -->
						</div>
					</div>
					<!-- end:single content -->
				</div>
				<?php include dirname(__FILE__).DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'includes'.DIRECTORY_SEPARATOR.'commons'.DIRECTORY_SEPARATOR."sidemenu.php"; ?>

			</div>
		</div>
	</div>
	<!-- end:single blog -->

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
	<script src="assets/UI/owl.carousel.min.js"></script>
	<script src="assets/UI/init.js"></script>
	<!-- end:javascript -->

</body>
</html>