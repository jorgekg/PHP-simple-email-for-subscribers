<?php

class LayoutController {

  private $publish_id;
  private $description;

  public function __construct($publish_id = null, $description = null) {
    $this->publish_id = $publish_id;
    $this->description = $description;
  }

  public function get($publish_id) {
    $conn = new DatabaseController();
    $instance = $conn->get_instance();
    $stmt = $instance->prepare("select * from layout_email where publish_id = ?");
    $stmt->bindValue(1, $publish_id);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
  }

  public function insert() {
    $conn = new DatabaseController();
    $instance = $conn->get_instance();
    $stmt = $instance->prepare("insert into layout_email (publish_id, message) values(?, ?)");
    $stmt->bindValue(1, $this->publish_id);
    $stmt->bindValue(2, $this->description);
    $stmt->execute();
    return $instance->lastInsertId();
  }

}