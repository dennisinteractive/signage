<?php

namespace Drupal\signage\Event\Scheduled;

use Drupal\node\Entity\Node;
use Drupal\signage\Action\ActionInterface;
use Drupal\signage\Channel\ChannelServiceInterface;
use Drupal\signage\Event\Input\InputEvent;
use Drupal\signage\Event\Payload\EventPayload;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

class ScheduledEventService implements ScheduledEventServiceInterface {

  /**
   * An empty cloneable action.
   *
   * @var \Drupal\signage\Action\ActionInterface
   */
  protected $action;

  /**
   * ActionService constructor.
   *
   * @param \Drupal\signage\Action\ActionInterface $action
   */
  public function __construct(
    ActionInterface $action,
    ChannelServiceInterface $channel_service,
    EventDispatcherInterface $event_dispatcher
  ) {
    $this->action = $action;
    $this->dispatcher = $event_dispatcher;
    $this->channelService = $channel_service;
  }

  /**
   * @inheritDoc
   */
  public function getActions() {
    $actions = [];

    $scheduled_events = \Drupal::entityQuery('node')
      ->exists('field_signage_scheduled_event')
      ->execute()
    ;

    if (empty($scheduled_events)) {
      return $actions;
    }

    $payload = new EventPayload();
    $event = new InputEvent('schedule');
    $event->setPayload($payload);

    foreach ($scheduled_events as $nid) {
      $action = clone $this->action;
      if ($node = Node::load($nid)) {
        if ($this->actionDue($node)) {
          $action->setNode($node);
          $action->setInputEvent($event);
          $actions[] = $action;
        }
      }
    }

    return $actions;
  }

  public function processScheduledEvents() {
   $this->dispatchActions($this->getActions());
  }

  public function dispatchActions($actions) {
    foreach ($actions as $action) {
      $oe = $action->getOutputEvent();
      // Send the event to all the relevant channels.
      $channels = $this->channelService->getChannelsForAction($action);
      foreach ($channels as $channel) {
        $oe->setChannel($channel);
        $this->dispatcher->dispatch($oe::name(), $oe);
      }
    }
  }

  /**
   * @inheritDoc
   */
  public function actionDue(Node $node) {
    $expression = $node->get('field_signage_scheduled_event')->getValue()[0]['value'];
    $cron = \Cron\CronExpression::factory($expression);

    // Cron is run every 5 minutes on the server, NOT every minute.
    // So check isDue() for the current minute & the previous four.
    // Expected to run once every 5 minutes.
    for ($minutes = 4; $minutes > 0; $minutes--) {
      if ($cron->isDue('-' . $minutes . ' minutes')) {
        return TRUE;
      }
    }
    // The current minute.
    if ($cron->isDue()) {
      return TRUE;
    }
    return FALSE;
  }
}
