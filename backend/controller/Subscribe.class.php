<?php

class SubscribeController {
  private $name;
  private $email;

  public function __construct($name = null, $email = null) {
    $this->name = $name;
    $this->email = $email;
  }

  public function getAll() {
    $conn = new DatabaseController();
    $instance = $conn->get_instance();
    $stmt = $instance->query("
      select * from subscribe
    ");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }

  public function getNextEmail($id) {
    $conn = new DatabaseController();
    $instance = $conn->get_instance();
    $stmt = $instance->query("
      select * from subscribe t1
      left join publish_subscribe t2 on t2.subscribe_id = t1.id
      where t2.publish_id > {($id - 1)}
      and t2.publish_id < {($id + 1)}
    ");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }

  public function insert() {
      $conn = new DatabaseController();
      $instance = $conn->get_instance();
      $stmt = $instance->prepare("insert into subscribe (name, email) values(?, ?)");
      $stmt->bindValue(1, $this->name);
      $stmt->bindValue(2, $this->email);
      $stmt->execute();
      return $instance->lastInsertId();
  }
}