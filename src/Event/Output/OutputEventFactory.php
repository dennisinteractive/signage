<?php
/**
 * Creates output events.
 */

namespace Drupal\signage\Event\Output;

/**
 * Class OutputEventFactory.
 *
 * @package Drupal\signage\Event
 */
class OutputEventFactory implements OutputEventFactoryInterface {

  /**
   * Registry of blank output events ready for cloning.
   * @var array
   */
  protected $events = [];

  /**
   * @inheritDoc
   */
  public function addEvent(OutputEventInterface $event) {
    $this->events[$event::name()] = $event;
  }

  /**
   * @inheritDoc
   */
  public function getEvent($name) {
    if (isset($this->events[$name])) {
      // Send a copy of the blank event.
      $event = clone $this->events[$name];
      // Need to also clone the original paylaoad too.
      $event->setPayload(clone $event->getPayload());
      return $event;
    }

  }


}
