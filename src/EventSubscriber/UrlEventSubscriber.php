<?php
/**
 * Subscribe to url output events.
 */

namespace Drupal\signage\EventSubscriber;

use Drupal\signage\Event\OutputEventInterface;
use Drupal\signage\Event\UrlEventInterface;
use Drupal\signage\Service\PendingActionServiceInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

/**
 * Class UrlEventSubscriber.
 *
 * @package Drupal\signage\EventSubscriber
 */
class UrlEventSubscriber implements EventSubscriberInterface, OutputEventSubscriberInterface {

  /**
   * @var \Drupal\signage\Service\PendingActionServiceInterface
   */
  protected $pendingActionService;

  /**
   * UrlEventSubscriber constructor.
   *
   * @param \Drupal\signage\Service\PendingActionServiceInterface $pendingActionService
   */
  public function __construct(PendingActionServiceInterface $pendingActionService) {
    $this->pendingActionService = $pendingActionService;
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
    $this->pendingActionService->addAction($event->getAction());
  }

}
