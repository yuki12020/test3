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
		<?php include_once "./../class/indexClass.php"; ?>
		<?php $id = $_GET["id"];       $obj=new index();?>
		<!--image_description_start-->
			<div class="fh5co-narrow-content">
				<div class="row row-bottom-padded-md">
					<div class="col-md-6 animate-box" data-animate-effect="fadeInLeft">
						<img class="img-responsive" src="images/img_bg_1.jpg" alt="Free HTML5 Bootstrap Template by FreeHTML5.co">
					</div>
					<div class="col-md-6 animate-box" data-animate-effect="fadeInLeft">
						<?php 
							$select_querry = $obj->select_detail($id);
							foreach($select_querry as $value){
								$result.="<h2 class="."fh5co-heading".">details</h2>";
								$result.="<h2>ID:".$value[id]."</h2>";
								$result.="<h2>keyword:".$value[keyword]."</h2>";
								$result.="<h2>kensu:".$value[kensu]."</h2>";
							}
							echo $result;						  
						?>
					</div>
				</div>
			</div>
		<!--image_description_end-->
			
		<!--details coloum start-->
			<div class="fh5co-narrow-content">
					<h2 class="fh5co-heading animate-box" data-animate-effect="fadeInLeft">
					てすと
					</h2>
						<div class="row">					
						<!--start-->
						<?php echo "sssss<br>";?>
						<?php echo "sssss";?>
						<!--end-->						
						</div>
			</div>
		<!--details colum end-->
				
		</div>
	</div>
	<?php  include dirname(__FILE__) ."./../include/jquery.php"; ?>
	</body>
</html>