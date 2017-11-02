<?php

namespace Drupal\signage\EventSubscriber;

use Drupal\signage\Event\InputEvent;
use Drupal\signage\Event\InputEventInterface;
use Drupal\signage\Event\MessageEvent;
use Drupal\signage\Event\UrlEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;


class DrupalMessageEventSubscriber implements EventSubscriberInterface {

  /**
   * @inheritDoc
   */
  public static function getSubscribedEvents() {
    $events['signage.input'][] = ['handleInput', 9];
    $events['signage.url'][] = ['handleUrl', 10];
    $events['signage.message'][] = ['handleMessage', 11];
    return $events;
  }

  /**
   * Callback for the input event.
   * @param InputEventInterface $event
   */
  public function handleInput(InputEventInterface $event) {
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
    $m = $event->getMessage();
    drupal_set_message(
      sprintf(
        'MessageEvent for channel: %s with title: %s & message: %s, of type: %s for %s seconds',
        $event->getChannelName(),
        $m->getTitle(),
        $m->getBody(),
        $m->getNotificationType(),
        $m->getTimeout()
      )
    );
  }

}
