<?php

namespace Drupal\signage\EventSubscriber;



use Drupal\signage\Action\ActionInterface;
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
   * Inform the channel about the current action.
   * @param \Drupal\signage\Action\ActionInterface $action
   *
   * @return self
   */
  public function updateChannels(ActionInterface $action);
}
