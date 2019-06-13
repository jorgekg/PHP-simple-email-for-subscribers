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
    where not exists (
      select 1 from publish_subscribe t2
        where t2.subscribe_id = t1.id
        and t2.publish_id = {$id}
        or (
          t2.create_at > DATE_SUB(now(), INTERVAL 1 DAY)
          and t2.subscribe_id = t1.id
          )
      )
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

  public function insert_publish($publish, $susbcribe) {
    $conn = new DatabaseController();
    $instance = $conn->get_instance();
    $stmt = $instance->prepare("insert into publish_subscribe (publish_id, subscribe_id, create_at) values(?, ?, ?)");
    $stmt->bindValue(1, $publish);
    $stmt->bindValue(2, $susbcribe);
    $stmt->bindValue(3, date('y-m-d 00:00:00'));
    $stmt->execute();
    return $instance->lastInsertId();
  }
}