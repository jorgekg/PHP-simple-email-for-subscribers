<?php

class PublishController {

  private $title;
  private $description;
  private $video;

  public function __construct($title, $description, $video) {
    $this->title = $title;
    $this->description = $description;
    $this->video = $video;
  }

  public function insert() {

    $uploadfile = './videos/' . basename($this->video['name']);

    if (move_uploaded_file($this->video['tmp_name'], $uploadfile)) {
      $conn = new DatabaseController();
      $instance = $conn->get_instance();
      $stmt = $instance->prepare("insert into publish (title, description, video) values(?, ?, ?)");
      $stmt->bindValue(0, $this->title);
      $stmt->bindValue(1, $this->description);
      $stmt->bindValue(2, basename($this->video['name']));
      $stmt->execute();
      return $instance->lastInsertId();
    } else {
      throw new Exception('Erro ao fazer upload do video');
    }
  }

}