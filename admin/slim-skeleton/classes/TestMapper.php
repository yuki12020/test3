<?php
class TestMapper extends Mapper
{
  public function getTests() {
    $sql = "select * from book";
    $stmt = $this->db->query($sql);
    $results = [];
    while($row = $stmt->fetch()) {
      $results[] = $row;
    }
    return $results;
  }
}