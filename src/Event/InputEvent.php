<?php
namespace Drupal\signage\Event;

use Symfony\Component\EventDispatcher\Event;

class InputEvent extends Event implements InputEventInterface {

  const NAME = 'signage.input';

  protected $payload;

  protected $source;

  /**
   * @inheritDoc
   */
  public function getSource() {
    return 'input_event';
  }

  /**
   * @inheritDoc
   */
  public function getPayload() {
    return $this->payload;
  }

  public function setPayload(EventPayload $payload) {
    $this->payload = $payload;
  }

}
