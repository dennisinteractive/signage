<?php
namespace Drupal\signage\Event;

use Symfony\Component\EventDispatcher\Event;

class InputEvent extends Event implements InputEventInterface {

  const NAME = 'signage.input';

  protected $payload;

  protected $source;

  public function __construct($source) {
    $this->setSource($source);
  }

  public function setSource($name) {
    $this->source = $name;

    return $this;
  }

  /**
   * @inheritDoc
   */
  public function getSource() {
    return $this->source;
  }

  /**
   * @inheritDoc
   */
  public function getPayload() {
    return $this->payload;
  }

  public function setPayload(EventPayload $payload) {
    $this->payload = $payload;

    return $this;
  }

}
