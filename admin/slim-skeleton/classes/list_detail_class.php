<?php
class list_detail_class extends Mapper
{
   public function ch_list_d($list) {
	 //重複を削除　distinct　キーワード
    $sql .="select * from channel_title_id";
	if($list==="未分類"){
	$sql .=" where list is null";
    }else{
	$sql .=" where list like "."'".$list."'";	
	}
	$stmt = $this->db->query($sql);
    $results = [];
    while($row = $stmt->fetch()) {
      $results[] = $row;
    }
    return $results;
  }
  
   public function ch_up_list($id,$list){
	$sql .="UPDATE `movie_info`.`channel_title_id` ";
	if($list===""){
	$sql .="set `list`= null";
	}else{
	$sql .="SET `list`='".$list."' ";
	}
	$sql .=" where `id`=".$id;
    $stmt = $this->db->query($sql);	 
	return $sql;   
  }
  
}
?>