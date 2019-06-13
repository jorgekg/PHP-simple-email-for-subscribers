<?php

require_once '../controller/Database.class.php';
require_once '../controller/Publish.class.php';
require_once '../controller/Subscribe.class.php';


$id = !empty($_GET['id']) ? $_POST['id']: null;
$title = !empty($_POST['title']) ? $_POST['title']: null;
$description = !empty($_POST['description']) ? $_POST['description'] : null;
$video = !empty($_FILES['video']) ? $_FILES['video'] : null;

try {
  $publish = new PublishController($title, $description, $video);
  $id = $publish->insert();
  header("location: ../../pages/publish/email.php?id={$id}");
} catch (Exception $e) {
  http_response_code(500);
  echo 'Ocorreu um erro interno';
  print_r($e);
}