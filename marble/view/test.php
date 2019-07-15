test.php
<?php 
//classの呼び出し
include_once "./../class/2chClass.php";
?>
<br><hr>
<?php
$obj=new index();
//var_dump($obj);
$select_querry = $obj->select_info();

//重複のidを削除
$tmp = [];
$unique_array = [];
foreach ($select_querry as $array_2){
   if (!in_array($array_2['id'], $tmp)) {
      $tmp[] = $array_2['id'];
      $unique_array[] = $array_2;
   }
}

foreach($unique_array as $key =>$value){
	$smt.="<a href="."./2chdetails.php/?id=".
	htmlspecialchars($value["id"],ENT_QUOTES,'UTF-8').">".$value["title"]."</a><br>";
	$smt.= "id:".$value["id"]."<br>";
	$smt.= "<hr>";	
}
echo $smt;
?>