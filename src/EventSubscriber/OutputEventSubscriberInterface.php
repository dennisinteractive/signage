<?php

namespace Drupal\signage\EventSubscriber;

use Drupal\signage\Event\OutputEventInterface;
use Drupal\signage\Service\ChannelServiceInterface;

interface OutputEventSubscriberInterface  {

  /**
   * The channel service.
   * @param \Drupal\signage\Service\ChannelServiceInterface $channelService
   *
   * @return self
   */
  public function setChannelService(ChannelServiceInterface $channelService);

  /**
   * Inform the channel about the output event.
   *
   * @param \Drupal\signage\Event\OutputEventInterface $event
   *
   * @return self
   */
  public function updateChannels(OutputEventInterface $event);
}
