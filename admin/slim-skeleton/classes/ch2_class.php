<?php
class ch2_class extends Mapper
{
  public function ch_info() {
    $sql = "select * from channel_title_id";
    $stmt = $this->db->query($sql);
    $results = [];
    while($row = $stmt->fetch()) {
      $results[] = $row;
    }
    return $results;
  }
  
  public function ch_del($id){
	$sql .="delete from `movie_info`.`channel`";
	$sql .=" where id=".$id;
	$stmt = $this->db->query($sql);
	return $sql;
  }

    public function ch_del_title($id){
	$sql .="delete from `movie_info`.`channel_title_id`";
	$sql .=" where id=".$id;
	$stmt = $this->db->query($sql);
	return $sql;
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