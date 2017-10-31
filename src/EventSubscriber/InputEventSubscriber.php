<?php

namespace Drupal\signage\EventSubscriber;

use Drupal\signage\Event\EventPayload;
use Drupal\signage\Event\InputEvent;
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

    // Handle the demo form.
    $dispatcher = \Drupal::service('event_dispatcher');
    if ($event->getSource() == 'demo.input') {
      // Build the url from the key value pairs.
      $vals = $event->getPayload()->getValues();
      $url = $vals['url'] . '?'
        . $vals['key_1'] . '=' . $vals['value_1'] . '&'
        . $vals['key_2'] . '=' . $vals['value_2']
      ;

      // @todo work out which event & which channel to use from the Actions content...
      $output_event = 'Drupal\signage\Event\UrlEvent';
      $channel = 'Floor4';


      $url_payload = new EventPayload();
      $url_payload->setValues($event->getPayload()->getValues());
      $url_event = new $output_event();
      $url_event->setChannelName($channel);
      $url_event->setPayload($url_payload);
      $dispatcher->dispatch($output_event::name(), $url_event);
    }

  }

  /*
   * Something like this to handle the processing of input events
   * with actions and channels.
  public function handleInputEvent(InputEvent $event) {

    $channelService = \Drupal::service('signage.channel');
    $actionService = \Drupal::service('signage.action');
    $dispatcher = \Drupal::service('event_dispatcher');

    // Action content for event source. eg; jenkins.deploy.success
    $actions = $actionService->getActionsForSource($event->getSource());
    foreach ($actions as $action) {
      $channel_name = $channelService->getChannelNameForActionId($action->getId());

      // eg; UrlEvent
      $event_name = $action->getOutputEventName();

      $oe = new $event_name();
      $oe->setChannelName($channel_name);
      $p = new Payload();
      foreach ($action->fields() as $k => $v) {
        $p->setValue($k, $v);
      }
      $oe->setPayload($p);

      $dispatcher->dispatch($oe->getName(), $oe);

    }
  }
  */

}
