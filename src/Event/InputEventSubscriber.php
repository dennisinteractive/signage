<?php

namespace Drupal\Signage\Event;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;


class InputEventSubscriber implements EventSubscriberInterface {

  /**
   * @inheritDoc
   */
  public static function getSubscribedEvents() {
    $events[UrlEvent::URL][] = ['handleUrl', 800];
    return $events;
  }

  /**
   * Subscriber Callback for the event.
   * @param UrlEvent $event
   */
  public function handleUrl(UrlEvent $event) {
    //@todo handleUrl();
  }

}
