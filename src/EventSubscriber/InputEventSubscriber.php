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
    $actions = $this->actionService->getActionsForInputEvent($event);
    foreach ($actions as $action) {
      $p = $action->getOutputPayload();

      // Build the new output event eg; UrlEvent
      $event_type = $action->getOutputEventType();
      //$eventService = \Drupal::service('signage.event.<url>.service');
      $oe = new $event_type();
      $oe->setPayload($p);

      // Send the event to all the relevant channels.
      $channel_names = $this->channelService->getChannelNamesForActionId($action->getId());
      foreach ($channel_names as $channel_name) {
        $oe->setChannelName($channel_name);
        $this->dispatcher->dispatch($oe::name(), $oe);
      }

    }

  }

}
