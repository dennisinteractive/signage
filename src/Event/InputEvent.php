<?php
namespace Drupal\signage\Event;

use Symfony\Component\EventDispatcher\Event;

class InputEvent extends Event implements InputEventInterface {

  const NAME = 'signage.input';

  protected $payload;

  protected $sourceName;

  protected $sourceEventName;

  public function __construct($source_name, $source_event_name) {
    $this->setSourceName($source_name);
    $this->setSourceEventName($source_event_name);
  }

  public function setSourceName($name) {
    $this->sourceName = $name;

    return $this;
  }

  public function setSourceEventName($name) {
    $this->sourceEventName = $name;

    return $this;
  }

  /**
   * @inheritDoc
   */
  public function getSourceName() {
    return $this->sourceName;
  }

  /**
   * @inheritDoc
   */
  public function getSourceEventName() {
    return $this->sourceEventName;
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
