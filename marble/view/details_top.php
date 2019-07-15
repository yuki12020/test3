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
			<?php 
			//classの呼び出し
			include_once "./../class/indexClass.php";
			?>
		<div id="fh5co-main">
			<div class="fh5co-narrow-content">
				<?php
				$id = $_GET["id"];
				$obj=new index();
				$select_querry = $obj->select_detail($id);
				foreach($select_querry as $value){
					$result.="<hr>";
					$result.="<h2>ID:".$value[id]."</h2>";
					$result.="<h2>keyword:".$value[keyword]."</h2>";
					$result.="<h2>kensu:".$value[kensu]."</h2>";
				}
				echo $result;
				?>
			</div>
		</div>
		
	</div>
	<?php  include dirname(__FILE__) ."./../include/jquery.php"; ?>
	</body>
</html>