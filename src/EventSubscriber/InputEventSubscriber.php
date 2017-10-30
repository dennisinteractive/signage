<?php

namespace Drupal\signage\EventSubscriber;

use Drupal\signage\Event\InputEvent;
use Drupal\signage\Event\MessageEvent;
use Drupal\signage\Event\UrlEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;


class InputEventSubscriber implements EventSubscriberInterface {

  /**
   * @inheritDoc
   */
  public static function getSubscribedEvents() {
    $events[InputEvent::NAME][] = ['handleInput', 700];
    $events[UrlEvent::URL][] = ['handleUrl', 800];
    $events[MessageEvent::MESSAGE][] = ['handleMessage', 900];
    return $events;
  }

  /**
   * Subscriber callback for the input event.
   * @param UrlEvent $event
   */
  public function handleInput(InputEvent $event) {
    $vals = $event->getPayload()->getValues();
    drupal_set_message("Input event: " . json_encode($vals));

    // Handle the demo form.
    $dispatcher = \Drupal::service('event_dispatcher');
    if ($event->getSourceEventName() == 'demo.input') {
      $url_event = new UrlEvent($vals['url']);
      $dispatcher->dispatch(UrlEvent::URL, $url_event);
    }

  }

  /**
   * Subscriber callback for the url event.
   * @param UrlEvent $event
   */
  public function handleUrl(UrlEvent $event) {
    drupal_set_message("Url event: " . $event->getUrl());
  }

  /**
   * Subscriber callback for the message event.
   * @param MessageEvent $event
   */
  public function handleMessage(MessageEvent $event) {
    drupal_set_message("Message event: " . $event->getMessage());
  }

}
