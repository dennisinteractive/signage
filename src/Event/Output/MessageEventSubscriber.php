<?php
/**
 * Subscribe to message output events.
 */

namespace Drupal\signage\Event\Output;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;

/**
 * Class MessageEventSubscriber.
 *
 * @package Drupal\signage\EventSubscriber
 */
class MessageEventSubscriber implements EventSubscriberInterface, OutputEventSubscriberInterface {

  /**
   * @inheritDoc
   */
  public static function getSubscribedEvents() {
    $events['signage.message'][] = ['handleOutputEvent', 0];

    return $events;
  }

  /**
   * @param MessageEventInterface $event
   */
  public function handleOutputEvent(MessageEventInterface $event) {
    $event->getChannel()->dispatched($event);

    // Update the current state.
    drupal_set_message(
      "handleOutputEvent: " . json_encode($event)
    );

  }

}
