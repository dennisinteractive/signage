<?php
/**
 * Subscribe to url output events.
 */

namespace Drupal\signage\EventSubscriber;

use Drupal\signage\Event\OutputEventInterface;
use Drupal\signage\Event\UrlEventInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

/**
 * Class UrlEventSubscriber.
 *
 * @package Drupal\signage\EventSubscriber
 */
class UrlEventSubscriber implements EventSubscriberInterface, OutputEventSubscriberInterface {

  /**
   * @inheritDoc
   */
  public static function getSubscribedEvents() {
    $events['signage.url'][] = ['handleOutputEvent', 0];

    return $events;
  }

  /**
   * @param \Drupal\signage\Event\UrlEventInterface $event
   */
  public function handleOutputEvent(UrlEventInterface $event) {
    $event->getChannel()->dispached($event);

    // Update the current state.
    drupal_set_message(
      "handleOutputEvent: " . json_encode($event)
    );

    //@todo PendingActionService that cron uses: event | payload | time

  }

}
