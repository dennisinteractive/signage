<?php
namespace Drupal\Signage\Event;

use Symfony\Component\EventDispatcher\Event;

class MessageEvent extends Event {

  const MESSAGE = 'signage.message';

  protected $message;

  protected $source;

  public function __construct($message = '') {
    $this->setMessage($message);
  }

  /**
   * The message the client should show.
   * @param $message string
   * @return self
   */
  public function setMessage($message) {
    $this->message = $message;

    return $this;
  }

  /**
   * The message.
   * @return string
   */
  public function getMessage() {
    return $this->message;
  }

}
