<?php
/**
 * Subscribe to url output events.
 */

namespace Drupal\signage\EventSubscriber;

use Drupal\signage\Event\OutputEventInterface;
use Drupal\signage\Event\UrlEventInterface;
use Drupal\signage\Service\PendingEventServiceInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

/**
 * Class UrlEventSubscriber.
 *
 * @package Drupal\signage\EventSubscriber
 */
class UrlEventSubscriber implements EventSubscriberInterface, OutputEventSubscriberInterface {

  /**
   * @var \Drupal\signage\Service\PendingEventServiceInterface
   */
  protected $pendingEventService;

  /**
   * UrlEventSubscriber constructor.
   *
   * @param \Drupal\signage\Service\PendingEventServiceInterface $pendingEventService
   */
  public function __construct(PendingEventServiceInterface $pendingEventService) {
    $this->pendingEventService = $pendingEventService;
  }

  /**
   * @inheritDoc
   */
  public static function getSubscribedEvents() {
    $events['signage.url'][] = ['handleOutputEvent', 0];

    return $events;
  }

  /**
   * @param \Drupal\signage\Event\UrlEventInterface $event
   */
  public function handleOutputEvent(UrlEventInterface $event) {
    $event->getChannel()->dispached($event);

    //TMP
    $this->pendingEventService->addEvent($event, time() + 10);

    // Update the current state.
    drupal_set_message(
      "handleOutputEvent: " . json_encode($event)
    );

    // @todo handle action field_signage_minimum_time
    // no other action should be sent while within the minimum time.
    // stored in the channel state?

    // Add a pending action for when this action times out.
    if ($max_time = $event->getAction()->getMaximumTime()) {
      $due = time() + $max_time;

      // Add a default url event.
      $this->pendingEventService->addEvent($event, $due);
    }
  }

}
