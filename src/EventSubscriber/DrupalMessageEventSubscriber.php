<?php
/**
 * Drupal messages for subscribed events, for debugging.
 */

namespace Drupal\signage\EventSubscriber;

use Drupal\signage\Event\InputEventInterface;
use Drupal\signage\Event\MessageEventInterface;
use Drupal\signage\Event\UrlEventInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

/**
 * Class DrupalMessageEventSubscriber.
 *
 * @package Drupal\signage\EventSubscriber
 */
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
   * @param UrlEventInterface $event
   */
  public function handleUrl(UrlEventInterface $event) {
    drupal_set_message(
      sprintf(
        'UrlEvent for channel: %s with url: %s ',
        $event->getChannel()->getName(),
        $event->getUrl()
      )
    );
  }

  /**
   * Callback for the message event.
   * @param MessageEventInterface $event
   */
  public function handleMessage(MessageEventInterface $event) {
    $m = $event->getMessage();
    drupal_set_message(
      sprintf(
        'MessageEvent for channel: %s with title: %s & message: %s, of type: %s for %s seconds',
        $event->getChannel()->getName(),
        $m->getTitle(),
        $m->getBody(),
        $m->getNotificationType(),
        $m->getTimeout()
      )
    );
  }

}
