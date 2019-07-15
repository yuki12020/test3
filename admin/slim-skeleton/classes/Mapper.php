<?php
//db接続クラス。slimの仕様っぽい
abstract class Mapper {
  protected $db;
  public function __construct($db) {
    $this->db = $db;
  }
}