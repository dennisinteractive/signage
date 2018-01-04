<?php
/**
 * The channel change output event interface.
 */

namespace Drupal\signage\Channel;

/**
 * Interface ChannelChangeEventInterface
 *
 * @package Drupal\signage\Event
 */
interface ChannelChangeEventInterface {

  const NAME = 'signage.channel.change';

  /**
   * Get device.
   *
   * @return \Drupal\signage\Device\DeviceInterface
   */
  public function getDevice();

}
