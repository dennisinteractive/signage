<?php

namespace Drupal\Signage\Event;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;


class InputEventSubscriber implements EventSubscriberInterface {

  /**
   * @inheritDoc
   */
  public static function getSubscribedEvents() {
    $events[UrlEvent::URL][] = ['handleUrl', 800];
    $events[MessageEvent::MESSAGE][] = ['handleMessage', 900];
    return $events;
  }

  /**
   * Subscriber callback for the url event.
   * @param UrlEvent $event
   */
  public function handleUrl(UrlEvent $event) {
    //@todo handleUrl();
  }

  /**
   * Subscriber callback for the message event.
   * @param MessageEvent $event
   */
  public function handleMessage(MessageEvent $event) {
    //@todo handleUrl();
  }

}
