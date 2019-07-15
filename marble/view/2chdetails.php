2chdetails.php
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
		<?php include_once "./../class/2chClass.php";　?>
		<?php $id = $_GET[id]; $obj=new keijiban_index();?>
		<!--コンテンツの中身-->
		<?php include_once "./../class/2chClass.php";?>			
		<?php $obj = new keijiban_index(); //クラスのインスタンス作成?>
		<?php include dirname(__FILE__) ."./../include/2ch_oshirase.php"; //お知らせ読み込み ?>			
		<?php include dirname(__FILE__) ."./../include/2ch_pageing.php"; //ページング読み込み ?> 
		<!--ページング計算-->
		<?php
		(int)$cnt = $obj->total3($id);
		$page = 1;
		if (preg_match("/^[0-9]+$/", htmlspecialchars($_GET["page"]))){
		$_GET["page"] !== "0"?($page = (int)$_GET["page"]):$page = 1;
		}
		//$limit = 3;
		$limit = 0;
		$offset = ($page[0] - 1) * $limit;
		
		echo $id."----id---";
		echo $cnt;
		?>

		<!--image_description_start-->
			<div class="fh5co-narrow-content">
				<div class="row row-bottom-padded-md">
					<div class="col-md-6 animate-box" data-animate-effect="fadeInLeft">
						<img class="img-responsive" src="images/img_bg_1.jpg" alt="Free HTML5 Bootstrap Template by FreeHTML5.co">
					</div>
					<div class="col-md-6 animate-box" data-animate-effect="fadeInLeft">
						<?php 	//入力域		
						echo "testetsetest<br>";
						echo "testetsetest<br>";
						echo "testetsetest<br>";
						?>
					</div>
				</div>
			</div>
		<!--image_description_end-->
			
		<!--ページャー-->
		<?php echo pager($page,$cnt,$id);
		//echo "<h1>page:".$page."</h1>";
		?>
			
		<!--details coloum start-->
		<div class="fh5co-narrow-content">
			<h2 class="fh5co-heading animate-box" data-animate-effect="fadeInLeft">
			<?php 
			$title_k = $obj->select_title($id);
			echo "<h1 style="."color:green".";".">".$title_k[0]["title"]."</h1><br>";
			?>
			</h2>
				<div class="row">					
				<!--start-->
				<?php
				$select_querry = $obj->select_detail($page,$id);
				foreach($select_querry as $key =>$value){
					$smt.= "idnumber:";
					$smt.= "<b style="."color:green".";".">".$value["num"]."</b>";
					$smt .= "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
					$smt.= "<b style="."color:red".";".">".$value["uuid"]."</b><br>";
					$smt.= "<b>".$value["block"]."</b><br>";
					$smt.= "<hr>";	
				}
				echo $smt;
				?>
				<!--end-->						
				</div>
		</div>
		<!--details colum end-->
		
		<!--fotter処理 start-->
		<div class="fh5co-narrow-content">
		  <div class="row">					
		  <!--start-->
		  <!--ページャー　下に固定-->
		  <?php echo pager($page,$cnt,$id); ?>
		  <!--end-->						
		  </div>
		</div>
		<!--fotter処理　end-->
				
		</div>
	</div>
	<?php  include dirname(__FILE__) ."./../include/jquery.php"; ?>
	</body>
</html>