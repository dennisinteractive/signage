<?php

namespace Drupal\signage\EventSubscriber;

use Drupal\signage\Event\UrlEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;


class UrlEventSubscriber implements EventSubscriberInterface {

  /**
   * @inheritDoc
   */
  public static function getSubscribedEvents() {
    $events['signage.url'][] = ['handleUrlEvent', 0];

    return $events;
  }

  /**
   * @param \Drupal\signage\Event\UrlEvent $event
   */
  public function handleUrlEvent(UrlEvent $event) {
    // Update the current state.
    drupal_set_message(
      "UrlState: " . json_encode($event)
    );


    //@todo Store min & max times, channel etc so cron / daemon can send new events when needed.
  }

}
