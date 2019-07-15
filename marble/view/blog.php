<!DOCTYPE html>
<html class="no-js">
	<head>
	<?php  include dirname(__FILE__) ."./../include/head.php"; ?>
	</head>
	<body>
	<div id="fh5co-page">
		<a href="#" class="js-fh5co-nav-toggle fh5co-nav-toggle"><i></i></a>
		
		<!--style.cssのfh5co-asideにbackground:色;記述-->
		<aside id="fh5co-aside" role="complementary" class="border js-fullheight">
			<?php  include dirname(__FILE__) ."./../include/home.php"; ?>
			<?php  include dirname(__FILE__) ."./../include/sidebar.php"; ?>						
		</aside>

		<div id="fh5co-main">
			<div class="fh5co-narrow-content">
				<h2 class="fh5co-heading animate-box" data-animate-effect="fadeInLeft">Read Our Blog</h2>
				<div class="row row-bottom-padded-md">
					
					<!--box_start-->
					<div class="col-md-3 col-sm-6 col-padding animate-box" data-animate-effect="fadeInLeft">
						<div class="blog-entry">
							<a href="#" class="blog-img"><img src="images/img-2.jpg" class="img-responsive" alt="Free HTML5 Bootstrap Template by FreeHTML5.co"></a>
							<div class="desc">
								<h3><a href="#">Inspirational Website</a></h3>
								<span><small>by Admin </small> / <small> Web Design </small> / <small> <i class="icon-comment"></i> 14</small></span>
								<p>Design must be functional and functionality must be translated into visual aesthetics</p>
								<a href="#" class="lead">Read More <i class="icon-arrow-right3"></i></a>
							</div>
						</div>
					</div>
					
					<!--details.phpへのリンク読み込み-->
					<div class="col-md-3 col-sm-6 col-padding animate-box" data-animate-effect="fadeInLeft">
						<div class="blog-entry">
							<a href="http://192.168.179.6/marble_boot/marble/view/details.php" class="blog-img"><img src="images/img-2.jpg" class="img-responsive" alt="Free HTML5 Bootstrap Template by FreeHTML5.co"></a>
							<!--<div class="desc">-->
								<!--<h3><a href="#">details.phpテストてすと手素都</a></h3>
								<span><small>details.php</small></span>
								<p>details.phpの読み込む＿テスト</p>-->
								<a href="http://192.168.179.6/marble_boot/marble/view/details.php" 
								class="lead">
								<i class="btn btn-primary btn-learn">read more</i>
								</a>
								<p>test</p>
							-<!--</div>-->
						</div>
					</div>
					<!--box_end-->

				</div>
			</div>
		</div>		
			
	</div>
	<?php  include dirname(__FILE__) ."./../include/jquery.php"; ?>
	</body>
</html>