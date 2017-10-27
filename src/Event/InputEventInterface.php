<?php

namespace Drupal\Signage\Event;

interface InputEventInterface {

  /**
   * The module/input that created the event.
   * eg; Jenkins, GitHub etc
   *
   * @return string
   */
  public function getSource();

}
