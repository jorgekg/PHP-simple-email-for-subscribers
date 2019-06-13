<?php

require_once '../controller/Database.class.php';
require_once '../controller/Layout.class.php';
require_once '../controller/Subscribe.class.php';

$publish_id = !empty($_POST['publish_id']) ? $_POST['publish_id']: null;
$description = !empty($_POST['description']) ? $_POST['description'] : null;

try {
  $layout = new LayoutController($publish_id, $description);
  $layout->insert();
  header("location: ../../pages/videos/?id={$publish_id}");
} catch (Exception $e) {
  http_response_code(500);
  echo 'Ocorreu um erro interno';
  print_r($e);
}