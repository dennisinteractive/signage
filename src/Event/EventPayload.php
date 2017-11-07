<?php
namespace Drupal\signage\Event;


class EventPayload implements EventPayloadInterface {

  /**
   * @var array
   */
  protected $payload = [];

  /**
   * @inheritDoc
   */
  public function setValue($key, $value) {
    $this->payload[$key] = $value;

    return $this;
  }

  /**
   * @inheritDoc
   */
  public function setValues($array) {
    $this->payload = $array;

    return $this;
  }

  /**
   * @inheritDoc
   */
  public function getValues() {
    return $this->payload;
  }

}
