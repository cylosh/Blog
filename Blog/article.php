<?php
define("TITLE", 'Blog Title | Cylosh Blog');
define("HEADER_TITLE", 'The Cylosh Blog');
define("HEADER_SUBTITLE", 'Unfolding the Article');
?><!DOCTYPE html>
<html lang="en">
<head>
<?php include dirname(__FILE__).DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'includes'.DIRECTORY_SEPARATOR.'commons'.DIRECTORY_SEPARATOR."head.php"; ?>
</head>
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
	<?php include dirname(__FILE__).DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'includes'.DIRECTORY_SEPARATOR.'commons'.DIRECTORY_SEPARATOR."footer.php"; ?>


	<!-- start:javascript -->
	<script src="cached-assets/js/jquery-1.11.1.min.js,bootstrap.min.js,owl.carousel.min.js,particles/winter.js,particles/min.js,particles/init.js,init.js"></script>

	<!-- end:javascript -->

</body>
</html>