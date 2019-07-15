
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
				<?php echo "記述エリア---";?>
				<?php
				$obj=new index();
				var_dump($obj);
				$select_querry = $obj->perl();
				//var_dump($select_querry);
				echo "<br>";
				foreach($select_querry as $key =>$value){
					$smt.="<a href="."./details.php/?id=".
					htmlspecialchars($value["id"],ENT_QUOTES,'UTF-8').">".$value["keyword"]."</a><br>";
					$smt.= "id:".$value["id"]."<br>";
					$smt.= "件数:".$value["kensu"]."<br>";
					$smt.= "name:".$value["keyword"]."<br>";
					$smt.= "<hr>";	
				}
				echo $smt;
				?>
			</div>
		</div>
		
	</div>
	<?php  include dirname(__FILE__) ."./../include/jquery.php"; ?>
	</body>
</html>