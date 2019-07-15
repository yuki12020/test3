<?php
class ch2_class_details extends Mapper
{ 
  public function ch2_info_details($id) {
    $sql = "select * from channel where id=".$id;
    $stmt = $this->db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    return $stmt;
  }
  
  public function ch2_delete($id,$num){
	 $sql .= "delete from `movie_info`.`channel`";
	 $sql .= " where id=".$id." AND num=".$num;
	 $sql .= " limit 1";
	 $stmt = $this->db->query($sql);
	 return $sql;
  }
  
  public function ch2_update($id,$num,$block){
	 $sql .="UPDATE `movie_info`.`channel` ";
	 $sql .="SET `block`='".$block."' ";
	 $sql .= " where id=".$id." AND num=".$num;
	 $sql .= " limit 1";
	 $stmt = $this->db->query($sql);	 
	 return $sql; 
  }
  
}