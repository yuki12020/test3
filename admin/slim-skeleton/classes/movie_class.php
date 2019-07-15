<?php
class movie_class extends Mapper
{
  public function movie_info() {
    $sql = "select * from movie_info";
    $stmt = $this->db->query($sql);
    $results = [];
    while($row = $stmt->fetch()) {
      $results[] = $row;
    }
    return $results;
  }
}