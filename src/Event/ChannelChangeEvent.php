<?php


namespace Drupal\signage\Event;

use Drupal\signage\Channel\ChannelInterface;
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
   * @param \Drupal\signage\Channel\ChannelInterface $channel
   */
  public function __construct(ChannelInterface $device) {
    $this->device = $device;
  }

  /**
   * @inheritDoc
   */
  public function getDevice() {
    return $this->device;
  }

}
