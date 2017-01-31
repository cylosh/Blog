<?php
define("TITLE", 'Blog Title | Cylosh Blog');
define("HEADER_TITLE", 'The Cylosh Blog');
define("HEADER_SUBTITLE", 'Unfolding the Article');
?><!DOCTYPE html>
<html lang="en">
<head>
<?php include $this->GetTemplate('head'); ?>
</head>
<body>
<?php include $this->GetTemplate('header'); ?>

<article id="scrolltojs"></article> <!-- hack to check its an blog article that needs to automatically scroll to the content -->
<?php include $this->GetTemplate('menu'); ?>

	<!-- start:single blog -->
	<div id="single-blog">
		<div class="container">
			<div class="row">
				<div class="col-lg-8 col-md-8">
					<!-- start:single content -->
					<div id="main-single-content">
						<img src="<?php if(isset($this->Response['ImgPath'])) echo $this->Response['ImgPath']; ?> " class="img-responsive">
						<div class="content-single">
							<h2><?php if(isset($this->Response['Title'])) echo $this->Response['Title']; ?></h2>
							<div class="tag">
								<p>	
									<span><i class="fa fa-calendar"></i> <a href="#" onclick="return false;"><?php if(isset($this->Response['Created'])) echo date('j\ M\ Y', strtotime($this->Response['Created'])); ?></a></span>
									<i class="fa fa-circle"></i>
									<span><i class="fa fa-tag"></i> <?php if(!empty($this->Response['Tags'])){ $tags = explode(',', $this->Response['tags']); foreach($tags as $tag) echo '<a href="#" onclick="return false;">'.$tag.'</a>'; } ?></span>
								</p>
							</div>
							<div class="hr-single"></div>
							<div style="word-wrap: break-word;"><?php if(isset($this->Response['Content'])) echo $this->Response['Content']; ?></div>
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
<?php include $this->GetTemplate('sidemenu'); ?>

			</div>
		</div>
	</div>
	<!-- end:single blog -->

	<!-- start:footer -->
<?php include $this->GetTemplate('footer'); ?>


	<!-- start:javascript -->
	<script src="cached-assets/js/jquery-1.11.1.min.js,bootstrap.min.js,owl.carousel.min.js,particles/winter.js,particles/min.js,particles/init.js,init.js"></script>

	<!-- end:javascript -->

</body>
</html>