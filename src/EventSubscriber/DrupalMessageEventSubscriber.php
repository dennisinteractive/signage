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
    $events[UrlEvent::URL][] = ['handleUrl', 10];
    $events[MessageEvent::MESSAGE][] = ['handleMessage', 11];
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
    drupal_set_message("Url event: " . $event->getUrl());
  }

  /**s
   * Callback for the message event.
   * @param MessageEvent $event
   */
  public function handleMessage(MessageEvent $event) {
    drupal_set_message("Message event: " . $event->getMessage());
  }

}
