<?php

require_once '../controller/Database.class.php';
require_once '../controller/Publish.class.php';
require_once '../controller/Subscribe.class.php';
require '../mailer/PHPMailer/PHPMailerAutoload.php';

try {
  $publsh = new PublishController();
  $publishs = $publsh->getAll();
  foreach ($publishs as $key) {
    $subscribe = new SubscribeController();
    $pessoas = $subscribe->getNextEmail($key['id']);
    $mail = new PHPMailer();
    $mail->isSMTP();
    $mail->Host = 'smtp.hostinger.com.br';
    $mail->SMTPAuth = true;
    $mail->SMTPSecure = 'tls';
    $mail->Username = 'cosmoshealth@cosmoshealth.com.br';
    $mail->Password = 'senha';
    $mail->Port = 587;
    foreach ($pessoas as $person) {
      try {
        $mail->setFrom('cosmoshealth@cosmoshealth.com.br');
        $mail->addAddress($person['email'], $person['name']);
        $mail->isHTML(true);
        $mail->Subject = $title;
        $mail->Body    = 'Este é o conteúdo da mensagem em <b>HTML!</b>';
        $mail->AltBody = 'Para visualizar essa mensagem acesse http://site.com.br/mail';

      } catch (Exception $b) {
        echo "Não foi possível enviar email";
      }
    }
  }
} catch (Exception $e) {
  print_r($e);
}