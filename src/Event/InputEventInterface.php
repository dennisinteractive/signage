<?php

namespace Drupal\signage\Event;

interface InputEventInterface {

  /**
   * The module/input that created the event.
   * eg; Jenkins, GitHub etc
   *
   * @return string
   */
  public function getSource();

  /**
   *
   * @return EventPayload
   */
  public function getPayload();

  public function setPayload(EventPayload $payload);
}
