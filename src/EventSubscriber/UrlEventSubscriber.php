<?php
/**
 * Subscribe to url output events.
 */

namespace Drupal\signage\EventSubscriber;

use Drupal\signage\Event\InputEvent;
use Drupal\signage\Event\UrlEventInterface;
use Drupal\signage\Service\PendingInputEventInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

/**
 * Class UrlEventSubscriber.
 *
 * @package Drupal\signage\EventSubscriber
 */
class UrlEventSubscriber implements EventSubscriberInterface, OutputEventSubscriberInterface {

  /**
   * @var \Drupal\signage\Service\PendingInputEventInterface
   */
  protected $pendingInputEvent;

  /**
   * UrlEventSubscriber constructor.
   *
   * @param \Drupal\signage\Service\PendingInputEventInterface $pendingInputEvent
   */
  public function __construct(PendingInputEventInterface $pendingInputEvent) {
    $this->pendingInputEvent = $pendingInputEvent;
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

    // Update the current state.
    drupal_set_message(
      "handleOutputEvent: " . json_encode($event)
    );

    //@todo PendingActionService that cron uses: event | payload | time
    $cron_event = new InputEvent($event->getPayload());
    $this->pendingInputEvent->addInputEvent($cron_event,time() + 10);

//    if ($max_time = $event->getAction()->getMaximumTime()) {
//      $due = time() + $max_time;
//      // Add a default url event.
    //  $cron_event = new InputEvent($event->getPayload());
//      $this->pendingInputEvent->addInputEvent($cron_event, $due);
//    }

  }

}
