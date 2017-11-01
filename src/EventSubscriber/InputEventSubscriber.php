<?php

namespace Drupal\signage\EventSubscriber;

use Drupal\signage\Event\EventPayload;
use Drupal\signage\Event\InputEvent;
use Drupal\signage\Service\ActionServiceInterface;
use Drupal\signage\Service\ChannelServiceInterface;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;


class InputEventSubscriber implements EventSubscriberInterface {

  /**
   * @var \Symfony\Component\EventDispatcher\EventDispatcherInterface
   */
  protected $dispatcher;

  /**
   * @var \Drupal\signage\Service\ActionServiceInterface
   */
  protected $actionService;

  /**
   * @var \Drupal\signage\Service\ChannelServiceInterface
   */
  protected $channelService;

  /**
   * InputEventSubscriber constructor.
   *
   * @param \Symfony\Component\EventDispatcher\EventDispatcherInterface $event_dispatcher
   * @param \Drupal\signage\Service\ActionServiceInterface $action_service
   * @param \Drupal\signage\Service\ChannelServiceInterface $channel_service
   */
  public function __construct(
    EventDispatcherInterface $event_dispatcher,
    ActionServiceInterface $action_service,
    ChannelServiceInterface $channel_service
  ) {
    $this->dispatcher = $event_dispatcher;
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
    // Action content for event source. eg; jenkins.deploy.success
    $actions = $this->actionService->getActionsForSource($event->getSource());
    foreach ($actions as $action) {
      $channel_names = $this->channelService->getChannelNamesForActionId($action->getId());

      $vals = $event->getPayload()->getValues();
      $p = new EventPayload();
      foreach ($action->getFields() as $k) {
        if (isset($vals[$k])) {
          $p->setValue($k, $vals[$k]);
        }
      }

      // Build the new output event eg; UrlEvent
      $event_type = $action->getOutputEventType();
      //$eventService = \Drupal::service('signage.event.<url>.service');
      $oe = new $event_type();
      $oe->setPayload($p);

      // Send the event to all the relevant chnnels.
      foreach ($channel_names as $channel_name) {
        $oe->setChannelName($channel_name);
        $this->dispatcher->dispatch($oe::name(), $oe);
      }

    }


//    // Handle the demo form.
//    if ($event->getSource() == 'demo.input') {
//      // Build the url from the key value pairs.
//      $vals = $event->getPayload()->getValues();
//      $url = $vals['url'] . '?'
//        . $vals['key_1'] . '=' . $vals['value_1'] . '&'
//        . $vals['key_2'] . '=' . $vals['value_2']
//      ;
//
//      // @todo work out which event & which channel to use from the Actions content...
//      $output_event = 'Drupal\signage\Event\UrlEvent';
//      $channel = 'Floor4';
//      $values = ['url' => $url];
//
//
//      $url_payload = new EventPayload();
//      $url_payload->setValues($values);
//      $url_event = new $output_event();
//      $url_event->setChannelName($channel);
//      $url_event->setPayload($url_payload);
//      $dispatcher->dispatch($output_event::name(), $url_event);
//    }

  }

}
