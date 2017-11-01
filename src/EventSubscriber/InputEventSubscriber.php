<?php

namespace Drupal\signage\EventSubscriber;

use Drupal\signage\Event\EventPayload;
use Drupal\signage\Event\InputEvent;
use Drupal\signage\Service\ActionServiceInterface;
use Drupal\signage\Service\ChannelServiceInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;


class InputEventSubscriber implements EventSubscriberInterface {

  protected $actionService;
  protected $channelService;

  /**
   * InputEventSubscriber constructor.
   *
   * @param \Drupal\signage\Service\ActionServiceInterface $action_service
   * @param \Drupal\signage\Service\ChannelServiceInterface $channel_service
   */
  public function __construct(ActionServiceInterface $action_service, ChannelServiceInterface $channel_service) {
    $this->actionService = $action_service;
    $this->channelService = $channel_service;
  }

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

    // TMP to show dependency injection works.
    $this->channelService->getChannelNamesForActionId(1);
    $this->actionService->getActionsForSource('foo');

    //$eventService = \Drupal::service('signage.event.<url>.service');

    $dispatcher = \Drupal::service('event_dispatcher');

    // Handle the demo form.
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
      $values = ['url' => $url];


      $url_payload = new EventPayload();
      $url_payload->setValues($values);
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
      $channel_names = $channelService->getChannelNamesForActionId($action->getId());

      $p = new Payload();
      foreach ($action->getFields() as $k => $v) {
        $p->setValue($k, $v);
      }
      $oe->setPayload($p);

      // eg; UrlEvent
      $event_type = $action->getOutputEventType();
      $oe = new $event_type();
      foreach ($channel_names as $channel_name) {
        $oe->setChannelName($channel_name);
        $dispatcher->dispatch($oe->getName(), $oe);
      }

    }
  }
  */

}
