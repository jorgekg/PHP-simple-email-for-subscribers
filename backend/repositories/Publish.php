<?php

require_once '../controller/Database.class.php';
require_once '../controller/Publish.class.php';

$title = !empty($_POST['title']) ? $_POST['title']: null;
$description = !empty($_POST['description']) ? $_POST['description'] : null;
$video = !empty($_FILES['video']) ? $_FILES['video'] : null;

try {
  $publish = new PublishController($title, $description, $video);
  $id = $publish->insert();
} catch (Exception $e) {
  echo 'Ocorreu um erro interno';
  print_r($e);
}