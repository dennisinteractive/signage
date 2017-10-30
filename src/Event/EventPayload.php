<?php
namespace Drupal\Signage\Event;


class EventPayload {

  protected $payload;


  /**
   * @param $key
   * @param $value
   *
   * @return $this
   */
  public function setValue($key, $value) {
    $this->payload[$key] = $value;

    return $this;
  }

  /**
   * @return mixed
   */
  public function getValues() {
    return $this->payload;
  }

}
