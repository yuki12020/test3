<?php
class TestMapper_detail extends Mapper
{
  public function getTests_details($id) {
    $sql = "select * from book where id=".$id;
    $stmt = $this->db->query($sql);
    $results = [];
    while($row = $stmt->fetch()) {
      $results[] = $row;
    }
    return $results;
  }
}