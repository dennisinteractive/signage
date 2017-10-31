<?php

namespace Drupal\signage\EventSubscriber;

use Drupal\signage\Event\InputEvent;
use Drupal\signage\Event\MessageEvent;
use Drupal\signage\Event\UrlEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;


class DrupalMessageEventSubscriber implements EventSubscriberInterface {

  /**
   * @inheritDoc
   */
  public static function getSubscribedEvents() {
    $events[InputEvent::NAME][] = ['handleInput', 9];
    $events[UrlEvent::NAME][] = ['handleUrl', 10];
    $events[MessageEvent::NAME][] = ['handleMessage', 11];
    return $events;
  }

  /**
   * Callback for the input event.
   * @param InputEvent $event
   */
  public function handleInput(InputEvent $event) {
    drupal_set_message(
      "Input event: " . json_encode($event->getPayload()->getValues())
    );
  }

  /**
   * Callback for the url event.
   * @param UrlEvent $event
   */
  public function handleUrl(UrlEvent $event) {
    drupal_set_message(
      sprintf(
        'UrlEvent for channel: %s with url: %s ',
        $event->getChannelName(),
        $event->getUrl()
      )
    );
  }

  /**s
   * Callback for the message event.
   * @param MessageEvent $event
   */
  public function handleMessage(MessageEvent $event) {
    drupal_set_message(
      sprintf(
        'MessageEvent for channel: %s with url: %s ',
        $event->getChannelName(),
        $event->getMessage()
      )
    );
  }

}
