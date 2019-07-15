<?php
class movie_class_details extends Mapper
{ 
  public function movie_info_details($id) {
    $sql = "select * from movie_info where id=".$id;
    $stmt = $this->db->query($sql);
    $results = [];
    while($row = $stmt->fetch()) {
      $results[] = $row;
    }
    return $results;
  }
}