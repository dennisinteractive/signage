<?php


namespace Drupal\signage\Event;

use Drupal\signage\Device\DeviceInterface;
use Symfony\Component\EventDispatcher\Event;

/**
 * Class ChannelChangeEvent.
 *
 * @package Drupal\signage\Event
 */
class ChannelChangeEvent extends Event implements ChannelChangeEventInterface {

  /**
   * @var \Drupal\signage\Channel\ChannelInterface
   */
  protected $device;

  /**
   * ChannelChangeEvent constructor.
   *
   * @param \Drupal\signage\Device\DeviceInterface $device
   */
  public function __construct(DeviceInterface $device) {
    $this->device = $device;
  }

  /**
   * @inheritDoc
   */
  public function getDevice() {
    return $this->device;
  }

}
