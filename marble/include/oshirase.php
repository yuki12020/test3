 <style type="text/css">
	 .box{
	  text-align: left;		 
	 }
    .box_srcollbar {
        overflow:auto;
        width:100%;
        height:150px;
        padding:5px;
        border:1px solid #000;
        background-color:#eee;
        color:#000;
        font-size:12px;
    }
    .box_title{
        border:1px solid #000;
        padding:5px;
        width:200px;
        font-weight:bold;
        font-size:14px;
        background-color:#000;
        color:#fff;
		text-align: center;	
    }
</style>
<?php include_once "./../class/indexClass.php";?>			
<?php $obj = new index(); //クラスのインスタンス作成?>
<div class="box_title">新着（15件）</div>
<div class="box">
	<div class="box_srcollbar">
		<?php 
		$select_q = $obj->select_info();
		//shuffle($select_q); //ランダムにする関数。最新15件ならば子の関数をかませない
		for($i=0; $i <=15; $i++){
		 $str .= "<small style="."color:red".";".">id".$select_q[$i]["id"]."</small>";	
		 $str.="<a href=".
		 "./details.php?id=".
		 htmlspecialchars($select_q[$i]["id"],ENT_QUOTES,'UTF-8').">"
		 ."::検索文字列".$select_q[$i]["keyword"]."</a>";
		 $str .="::件数".$select_q[$i]["kensu"];
		 $str .="<br>";
		}
		 echo $str;
		?>
	</div>
</div>