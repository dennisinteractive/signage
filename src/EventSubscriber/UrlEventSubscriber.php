<?php

namespace Drupal\signage\EventSubscriber;

use Drupal\signage\Event\OutputEventInterface;
use Drupal\signage\Event\UrlEventInterface;
use Drupal\signage\Service\ChannelServiceInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;


class UrlEventSubscriber implements EventSubscriberInterface, OutputEventSubscriberInterface {

  /**
   * @var ChannelServiceInterface
   */
  protected $channelService;

  /**
   * @inheritDoc
   */
  public static function getSubscribedEvents() {
    $events['signage.url'][] = ['handleUrlEvent', 0];

    return $events;
  }

  /**
   * @param \Drupal\signage\Event\UrlEventInterface $event
   */
  public function handleUrlEvent(UrlEventInterface $event) {
    $this->updateChannel($event);

    // Update the current state.
    drupal_set_message(
      "UrlState: " . json_encode($event)
    );

    //@todo PendingActionService that cron uses: event | payload | time

  }

  /**
   * @inheritDoc
   */
  public function updateChannel(OutputEventInterface $event) {
    // Store event details so the channel know what it is currently showing.
    $channel = $event->getChannel();
    $channel->addOutputEvent($event);
  }

}
