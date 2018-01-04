<?php
/**
 * Interface for the output event factory.
 */

namespace Drupal\signage\Event\Output;

/**
 * Interface OutputEventFactoryInterface.
 *
 * @package Drupal\signage\Event
 */
interface OutputEventFactoryInterface {

  /**
   * Registers available output events.
   *
   * @param OutputEventInterface $event
   *
   * @return mixed
   */
  public function addEvent(OutputEventInterface $event);

  /**
   * Gets the requested output event object.
   *
   * @param $name
   *
   * @return OutputEventInterface
   */
  public function getEvent($name);
}
