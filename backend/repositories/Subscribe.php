<?php

require_once '../controller/Database.class.php';
require_once '../controller/Subscribe.class.php';

$name = !empty($_POST['name']) ? $_POST['name']: null;
$email = !empty($_POST['email']) ? $_POST['email'] : null;

try {
  $subscribe = new SubscribeController($name, $email, $video);
  $subscribe->insert();
  echo json_encode([]);
} catch (Exception $e) {
  http_response_code(500);
  echo 'Ocorreu um erro interno';
  print_r($e);
}