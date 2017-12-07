<?php
/**
 * Perform the actions for input events.
 */

namespace Drupal\signage\EventSubscriber;

use Drupal\signage\Event\InputEventInterface;
use Drupal\signage\Service\ActionServiceInterface;
use Drupal\signage\Service\ChannelServiceInterface;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

/**
 * Class InputEventSubscriber.
 *
 * @package Drupal\signage\EventSubscriber
 */
class InputEventSubscriber implements EventSubscriberInterface {

  /**
   * The event dispatcher.
   *
   * @var \Symfony\Component\EventDispatcher\EventDispatcherInterface
   */
  protected $dispatcher;

  /**
   * The action service.
   *
   * @var \Drupal\signage\Service\ActionServiceInterface
   */
  protected $actionService;

  /**
   * The channel service.
   *
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
    $events['signage.input'][] = ['handleInputEvent', 1];
    return $events;
  }

  /**
   * Send the input event to actions that want it, then dispatch their responses.
   * @param InputEventInterface $event
   */
  public function handleInputEvent(InputEventInterface $event) {
    // Action content for event source. eg; jenkins.deploy.success
    $actions = $this->actionService->getActionsForInputEvent($event);
    foreach ($actions as $action) {
      $oe = $action->getOutputEvent();
      // Send the event to all the relevant channels.
      $channels = $this->channelService->getChannelsForActionId($action->getId());
      foreach ($channels as $channel) {
        $oe->setChannel($channel);
        // @todo handle action field_signage_minimum_time
        // no other action should be sent while within the minimum time.
        // stored in the channel state?
        $this->dispatcher->dispatch($oe::name(), $oe);
      }
    }
  }

}
