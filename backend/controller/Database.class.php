<?php

class DatabaseController {

  private $instance;

  public function get_instance() {
    if (empty($this->instance)) {
      $this->instance =
        new PDO('mysql:host=localhost;dbname=simple_email_subscribe', 'root', 'faccao12');
      $this->instance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
  }

}