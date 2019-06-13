<?php

require_once '../controller/Database.class.php';
require_once '../controller/Publish.class.php';
require_once '../controller/Layout.class.php';
require_once '../controller/Subscribe.class.php';

require '../mailer/PHPMailer/src/Exception.php';
require '../mailer/PHPMailer/src/PHPMailer.php';
require '../mailer/PHPMailer/src/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

try {
  $publsh = new PublishController();
  $publishs = $publsh->getAll();
  $layout = new LayoutController();
  $loop = 1;
  foreach ($publishs as $key) {
    $subscribe = new SubscribeController();
    $pessoas = $subscribe->getNextEmail($loop);
    $mail = new PHPMailer();
    $mail->isSMTP();
    $mail->Host = 'smtp.hostinger.com.br';
    $mail->SMTPAuth = true;
    $mail->SMTPSecure = 'tls';
    $mail->Username = 'elke.gass.dra@cosmoshealth.com.br';
    $mail->Password = 'Chblumenau';
    $mail->Port = 587;
    foreach ($pessoas as $person) {
      try {
        $subscribe->insert_publish($key["id"], $person["id"]);
        $mail->setFrom('elke.gass.dra@cosmoshealth.com.br');
        $mail->addAddress($person['email'], $person['name']);
        $mail->isHTML(true);
        $mail->Subject = utf8_decode($key["title"]);
        $mail->Body = "<p>".nl2br($layout->get($loop)["message"])."</p>".
          "<p style='center'><a href='http://cosmoshealth.com.br/pages/videos/?id=".($key["id"])."'>Clique aqui para visualizar o video</a></p>";
        if(!$mail->send()) {
          echo 'Não foi possível enviar a mensagem.<br>';
          echo 'Erro: ' . $mail->ErrorInfo;
        } else {
          echo 'Mensagem enviada.';
        }
      } catch (Exception $b) {
        echo "Não foi possível enviar email";
      }
    }
    $loop++;
  }
  echo "e-mails enviados com sucesso";
} catch (Exception $e) {
  print_r($e);
}