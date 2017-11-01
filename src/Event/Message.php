<?php
namespace Drupal\signage\Event;

class Message {

  protected $title;
  protected $body;
  protected $notificationType;
  protected $timeout;

  public function setTitle($title) {
    $this->title = $title;

    return $this;
  }

  public function getTitle() {
    return $this->title;
  }

  public function setBody($str) {
    $this->body = $str;

    return $this;
  }

  public function getBody() {
    return $this->body;
  }

  public function setNotificationType($str) {
    $this->notificationType = $str;

    return $this;
  }

  public function getNotificationType() {
    return $this->notificationType;
  }

  public function setTimeout($int) {
    $this->timeout = $int;

    return $this;
  }

  public function getTimeout() {
    return $this->timeout;
  }

}

