<?php
/**
 * Subscribe to message output events.
 */

namespace Drupal\signage\EventSubscriber;

use Drupal\signage\Event\MessageEventInterface;
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
   * @param \Drupal\signage\Event\MessageEventInterface $event
   */
  public function handleOutputEvent(MessageEventInterface $event) {
    $event->getChannel()->dispached($event);

    // Update the current state.
    drupal_set_message(
      "handleOutputEvent: " . json_encode($event)
    );

    //@todo PendingEventService that cron uses: event | payload | time

  }

}
