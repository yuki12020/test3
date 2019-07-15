<!DOCTYPE html>
<html class="no-js">
	<head>
	<?php  include dirname(__FILE__) ."./../include/head.php"; ?>
	</head>
	<body>
	<div id="fh5co-page">
		<a href="#" class="js-fh5co-nav-toggle fh5co-nav-toggle"><i></i></a>
		<aside id="fh5co-aside" role="complementary" class="border js-fullheight">
			<?php  include dirname(__FILE__) ."./../include/home.php"; ?>
			<?php  include dirname(__FILE__) ."./../include/sidebar.php"; ?>
		</aside>

		<div id="fh5co-main">
		
			<aside id="fh5co-hero" class="js-fullheight">
				<div class="flexslider js-fullheight">
					<ul class="slides">
					<?php  include dirname(__FILE__) ."./../include/index_slide.php"; ?>				
				  	</ul>
			  	</div>
			</aside>
			
			<div class="fh5co-narrow-content">
				<h2 class="fh5co-heading animate-box" data-animate-effect="fadeInLeft">Services</h2>
				<div class="row">
					<?php  include dirname(__FILE__) ."./../include/index_content.php"; ?>
				</div>
			</div>
						
			<div class="fh5co-narrow-content">
				<h2 class="fh5co-heading animate-box" data-animate-effect="fadeInLeft">Recent Blog</h2>
				<div class="row row-bottom-padded-md">
					<?php  include dirname(__FILE__) ."./../include/index_blog.php"; ?>					
				</div>
			</div>

		</div>
	</div>
	<?php  include dirname(__FILE__) ."./../include/jquery.php"; ?>
	</body>
</html>