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
		<!--コンテンツの中身-->
			<?php include_once "./../class/indexClass.php";?>			
			<?php $obj = new index(); //クラスのインスタンス作成?>
			<?php  include dirname(__FILE__) ."./../include/nav_above.php";　//タイトル画像,検索フォーム, メニューバー読み込み?>			
			<?php $target = $_GET[target]; ?>	
			<?php  include dirname(__FILE__) ."./../include/oshirase.php"; //お知らせ読み込み ?>			
			<?php include dirname(__FILE__) ."./../include/pageing.php"; //ページング読み込み ?> 
			<?php include dirname(__FILE__) ."./../include/page_select.php"; //ページング_select読み込み ?> 
			<?php  include dirname(__FILE__) ."./../include/btn_css.php"; //ボタンのcssの読み込み ?> 
			
			<!--ページング計算-->
			<?php
			(int)$cnt = $obj->total2($target);
			$page = 1;
			if (preg_match("/^[0-9]+$/", htmlspecialchars($_GET["page"]))){
			$_GET["page"] !== "0"?($page = (int)$_GET["page"]):$page = 1;
			}
			//$limit = 3;
			$limit = 0;
			$offset = ($page[0] - 1) * $limit;
			?>
			
			<!--ページャー-->
			<?php 
			if($target == ""){
			echo pager($page,$cnt);
			//echo "<h1>page:".$page."</h1>";
			}else{
			//検索後ページング処理　&で付加　./../include/page_select.php　に記述
			echo pager_select($page,$cnt,$target);
			//echo "<h1>page:".$page."</h1>";
			echo "<h1 style="."text-align".":"."center;".">検索文字:".$target."</h1>";
			}
			?>
			<div class="fh5co-narrow-content animate-box" data-animate-effect="fadeInLeft">
					
					<?php
					//selectで表示
					$select_querry = $obj->select($page,$target);
					foreach($select_querry as $key =>$value){
						$smt.="<div class="."col-md-3 col-sm-6 col-padding animate-box"." data-animate-effect="."fadeInLeft".">";
							$smt.="<div class="."blog-entry".">";
								$smt.="<a href="."./details.php?id="
								.htmlspecialchars($value["id"],ENT_QUOTES,'UTF-8')." class="."blog-img".">";
								$smt.="<img src="."images"."/"."notimage.jpg"." class="."img-responsive"." alt="."Free HTML5 Bootstrap Template by FreeHTML5.co".">";							
								$smt.="</a>";
								$smt.="<div class="."desc".">";
								
									$smt.= "<small><p style="."color:red".";".">id:".$value["id"]."</p></small>";
									$smt.= "<small><p style="."color:green".";".">".$value["keyword"]."</p></small>";
									$smt.= "<p>件数:".$value["kensu"]."</p>";						
									
									$smt.="<div style="."text-align:center;".">"; //ボタンの要素を中心に寄せる
										$smt.="<a href=".
										"./details.php?id=".
										htmlspecialchars($value["id"],ENT_QUOTES,'UTF-8')." 
										class="."lead".">"
										."<i class="."btn-square-shadow".">"."詳細"."</i>
										</a>";
									$smt.="</div>";
																		
								$smt.="</div>";	
								
							$smt.="</div>";
						$smt.="</div>";
					}
					echo $smt;
					?>
			</div>
			
			<!--fotter処理 start-->
			<div class="fh5co-narrow-content">
				<div class="row">					
				<!--start-->
				<!--ページャー　下に固定-->
				<?php 
				if($target == ""){
				echo pager($page,$cnt);
				}else{
				//検索後ページング処理　&で付加　./../include/page_select.php　に記述
				echo pager_select($page,$cnt,$target);
				}
				?>
				<!--end-->						
				</div>
			</div>
			<!--fotter処理　end-->
			
		 <!--コンテンツの中身　end-->
		</div>
		
	</div>
	<?php  include dirname(__FILE__) ."./../include/jquery.php"; ?>
	</body>
</html>