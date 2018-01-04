<?php
/**
 * Message for popups.
 */

namespace Drupal\signage\Message;

/**
 * Class Message.
 *
 * @package Drupal\signage\Event
 */
class Message implements MessageInterface {

  protected $title;
  protected $body;
  protected $notificationType;
  protected $timeout;

  /**
   * @inheritDoc
   */
  public function setTitle($title) {
    $this->title = $title;

    return $this;
  }

  /**
   * @inheritDoc
   */
  public function getTitle() {
    return $this->title;
  }

  /**
   * @inheritDoc
   */
  public function setBody($str) {
    $this->body = $str;

    return $this;
  }

  /**
   * @inheritDoc
   */
  public function getBody() {
    return $this->body;
  }

  /**
   * @inheritDoc
   */
  public function setNotificationType($str) {
    $this->notificationType = $str;

    return $this;
  }

  /**
   * @inheritDoc
   */
  public function getNotificationType() {
    return $this->notificationType;
  }

  /**
   * @inheritDoc
   */
  public function setTimeout($int) {
    $this->timeout = (int) $int;

    return $this;
  }

  /**
   * @inheritDoc
   */
  public function getTimeout() {
    return $this->timeout;
  }

}

