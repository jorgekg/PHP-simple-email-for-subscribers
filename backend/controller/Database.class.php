<?php

class DatabaseController {

  private $instance;

  public function get_instance() {
    if (empty($this->instance)) {
      $this->instance =
        new PDO('mysql:unix_socket=/tmp/mysql.sock;dbname=simple_email_subscribe', 'jorge', 'faccao12');
      $this->instance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    return $this->instance;
  }

}