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
    $events[InputEvent::NAME][] = ['handleInput', 1];
    return $events;
  }

  /**
   * Subscriber callback for the input event.
   * @param InputEvent $event
   */
  public function handleInput(InputEvent $event) {
    $vals = $event->getPayload()->getValues();

    // Handle the demo form.
    $dispatcher = \Drupal::service('event_dispatcher');
    if ($event->getSource() == 'demo.input') {
      // Build the url from the key value pairs.
      $url = $vals['url'] . '?'
        . $vals['key_1'] . '=' . $vals['value_1'] . '&'
        . $vals['key_2'] . '=' . $vals['value_2']
      ;
      $url_event = new UrlEvent($url);
      $dispatcher->dispatch(UrlEvent::URL, $url_event);
    }

  }

}
