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
			<?php  include dirname(__FILE__) ."./../include/nav_above.php"; ?>
			<div class="fh5co-narrow-content animate-box" data-animate-effect="fadeInLeft">
				<?php include_once "./../class/indexClass.php";?>			
					<?php
					$obj=new index();
					$select_querry = $obj->perl();
					foreach($select_querry as $key =>$value){
						$smt.="<div class="."col-md-3 col-sm-6 col-padding animate-box"." data-animate-effect="."fadeInLeft".">";
							$smt.="<div class="."blog-entry".">";
								$smt.= "<small><p style="."color:red".";".">id:".$value["id"]."</p></small>";
								$smt.= "<small><p style="."color:green".";".">".$value["keyword"]."</p></small>";
								$smt.="<img src="."images"."/"."notimage.jpg"." class="."img-responsive"." alt="."Free HTML5 Bootstrap Template by FreeHTML5.co".">";							
								$smt.="<div class="."fh5co-text".">";
									$smt.="<a href="."./details_top.php?id=".
									htmlspecialchars($value["id"],ENT_QUOTES,'UTF-8')." class="."lead".">"
									//."<p style="."color:blue".";".">".$value["keyword"]."</p>".
									."<i class="."btn btn-primary btn-learn".">"."詳細"."</i>".
									"</a>";
									$smt.= "<p>件数:".$value["kensu"]."</p>";						
								$smt.="</div>";							
							$smt.="</div>";
						$smt.="</div>";
					}
					echo $smt;
					?>
			</div>
		</div>
	</div>
	<?php  include dirname(__FILE__) ."./../include/jquery.php"; ?>
	</body>
</html>