<?php
/**
 * Subscribe to url output events.
 */

namespace Drupal\signage\Event\Output;


use Drupal\signage\Event\Pending\PendingEventServiceInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

/**
 * Class UrlEventSubscriber.
 *
 * @package Drupal\signage\EventSubscriber
 */
class UrlEventSubscriber implements EventSubscriberInterface, OutputEventSubscriberInterface {

  /**
   * @var PendingEventServiceInterface
   */
  protected $pendingEventService;

  /**
   * UrlEventSubscriber constructor.
   *
   * @param PendingEventServiceInterface $pendingEventService
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
   * @param \Drupal\signage\Event\Output\UrlEventInterface $event
   */
  public function handleOutputEvent(UrlEventInterface $event) {
    $event->getChannel()->dispatched($event);

    // Update the current state.
    drupal_set_message(
      "handleOutputEvent: " . json_encode($event)
    );

    // Add a pending event for when this action times out.
    if ($action = $event->getAction()) {
      if ($max_time = $action->getMaximumTime()) {
        $due = time() + $max_time;

        // Build a new url output event to set the default url later.
        $output_factory = \Drupal::getContainer()->get('signage.event.output.factory');
        $url_event = $output_factory->getEvent($event::name());
        $url_event->setUrl($event->getChannel()->getDefaultUrl());
        $event->getChannel()->unsetNode();
        $event->getChannel()->unsetSate();
        $url_event->setChannel(clone $event->getChannel());

        $this->pendingEventService->addEvent($url_event, $due);
      }
    }
  }

}
