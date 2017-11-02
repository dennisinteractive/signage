<?php

namespace Drupal\signage\Event;

interface OutputEventFactoryInterface {

  /**
   * Registers available output events.
   * @param \Drupal\signage\Event\OutputEventInterface $event
   *
   * @return mixed
   */
  public function addEvent(OutputEventInterface $event);

  /**
   * Gets the requested output event object.
   * @param $name
   *
   * @return \Drupal\signage\Event\OutputEventInterface
   */
  public function getEvent($name);
}
