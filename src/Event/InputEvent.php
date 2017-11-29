<?php
/**
 * The url input event.
 */

namespace Drupal\signage\Event;

use Symfony\Component\EventDispatcher\Event;

/**
 * Class InputEvent.
 *
 * @package Drupal\signage\Event
 */
class InputEvent extends Event implements InputEventInterface {

  const NAME = 'signage.input';

  /**
   * @var EventPayload
   */
  protected $payload;

  /**
   * @var string
   */
  protected $source;

  /**
   * InputEvent constructor.
   *
   * @param $source
   */
  public function __construct($source) {
    $this->setSource($source);
  }

  /**
   * @inheritDoc
   */
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

  /**
   * @inheritDoc
   */
  public function setPayload(EventPayloadInterface $payload) {
    $this->payload = $payload;

    return $this;
  }

}
