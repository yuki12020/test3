<style>
/*laptop*/
	.nav_bar >ul >li{
	  vertical-align: middle;
	  text-align: center;
	  width: 100%;
	  margin:10px;
	  padding: 50px;  
	  display: inline; /*横並びにする*/
	}
	.center{
	  text-align: center;	
	}
@media screen and (max-width: 1024px) { 
	.nav_bar >ul >li{
	  width: 100%;
	  padding: 0px;
	  margin:10px;
	  background-color:#f00; /*ipad pro*/
	}
	.center{
	  text-align: center;	
	}
}
@media screen and (max-width: 896px) { 
	.nav_bar >ul >li{
	  width: 100%;
	  padding: 0px;
	  margin:10px;
	  background-color:#ff0; /*ipad*/
	}
	.center{
	  text-align: center;	
	}
 }
@media screen and (max-width: 480px) { 
	.nav_bar >ul >li{
	  width: 100%;
	  padding: 0px;
	  margin:10px;
	  background-color:#00f; /*ipad X*/
	}
	.center{
	  text-align: center;	
	}
}

@media screen and (max-width: 450px) { 
	.nav_bar >ul >li{
	  width: 100%;
	  padding: 10px;
	  margin:10px;
	  background-color:#0ff; /*ipad 6*/
	}
	.center{
	  text-align: center;	
	}
}

@media screen and (max-width: 360px) { 
	.nav_bar >ul >li{
	  width: 100%;
	  padding: 0px;
	  margin:10px;
	  background-color:#f0f; /*galaxy s5*/
	}
	.center{
	  text-align: center;	
	}
}
</style>

<div class="fh5co-more-contact">
	<div class="fh5co-narrow-content" style= "padding:30px;">
		<a href="http://192.168.179.6/marble_boot/marble/view/"><img src="images/orlora.jpg" style="width: 100%; height: 150px; " alt="画像の説明文"></a>
	</div>
</div>

<div class="fh5co-more-contact">
	<div class="fh5co-narrow-content">
		<div style= "text-align :center;">
			<form  action ="<?=$_SERVER['SCRIPT_NAME']?>" method ="get">
				<input type = "text" name ="target" value="<?php echo $_POST[send];?>">
				<input type = "submit" value="検索">
			</form>
		</div> 
	</div>
</div>


<div class="fh5co-more-contact">
		<div class="center">
		<div class="nav_bar">
			<ul>
				<li class="fh5co-active"><a href="index.php">Top</a></li>
				<li><a href="2ch.php">2chクローラー</a></li>
				<li><a href="http://192.168.179.6/marble_boot/admin/slim-skeleton/public/ch2_info">ダッシュボード</a></li>	
				<li><a href="blog.php">test</a></li>
		
			  <!--
			  <li><a href=""><span><b>top</b></span></a></li>
			  <li><a href=""><span><b>home</b></span></a></li>
			  <li><a href=""><span><b>portfolio</b></span></a></li>
			  <li><a href=""><span><b>about</b></span></a></li>
			  -->
			 </ul>
		</div>
		</div>
</div>