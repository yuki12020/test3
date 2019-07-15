<?php
class list_class extends Mapper
{
  public function ch_info() {
	 //重複を削除　distinct　キーワード
    $sql .= "select distinct list from channel_title_id";
    $sql .=" order by list asc";
	$stmt = $this->db->query($sql);
    $results = [];
    while($row = $stmt->fetch()) {
      $results[] = $row;
    }
    return $results;
  }
  
}
?>