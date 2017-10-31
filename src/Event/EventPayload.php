<?php
namespace Drupal\signage\Event;


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

  public function setValues($array) {
    $this->payload = $array;

    return $this;
  }

  /**
   * @return mixed
   */
  public function getValues() {
    return $this->payload;
  }

}
