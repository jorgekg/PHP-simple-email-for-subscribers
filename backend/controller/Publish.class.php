<?php

class PublishController {

  private $title;
  private $description;
  private $video;

  public function __construct($title = null, $description = null, $video = null) {
    $this->title = $title;
    $this->description = $description;
    $this->video = $video;
  }

  public function get($id) {
    $conn = new DatabaseController();
    $instance = $conn->get_instance();
    $stmt = $instance->prepare("select * from publish where id = ?");
    $stmt->bindValue(1, $id);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
  }

  public function getAll($id) {
    $conn = new DatabaseController();
    $instance = $conn->get_instance();
    $stmt = $instance->query("select * from publish");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }

  public function insert() {

    $uploadfile = './videos/' . basename($this->video['name']);
    if (move_uploaded_file($this->video['tmp_name'], $uploadfile)) {
      $conn = new DatabaseController();
      $instance = $conn->get_instance();
      $stmt = $instance->prepare("insert into publish (title, description, video, mime) values(?, ?, ?, ?)");
      $stmt->bindValue(1, $this->title);
      $stmt->bindValue(2, $this->description);
      $stmt->bindValue(3, basename($this->video['name']));
      $stmt->bindValue(4, basename($this->video['type']));
      $stmt->execute();
      return $instance->lastInsertId();
    } else {
      throw new Exception('Erro ao fazer upload do video');
    }
  }

}