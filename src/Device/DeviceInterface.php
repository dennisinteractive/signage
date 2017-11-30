<?php
/**
 * Device interface.
 */

namespace Drupal\signage\Device;

use Drupal\node\NodeInterface;

/**
 * Interface DeviceInterface.
 *
 * @package Drupal\signage\Device
 */
interface DeviceInterface {

  /**
   * The id of the device.
   *
   * @return int
   */
  public function getId();

  /**
   * The device name.
   *
   * @return string
   */
  public function getName();

  /**
   * The drupal entity, as returned by node_load().
   *
   * @param NodeInterface $entity
   *
   * @return self
   */
  public function setNode(NodeInterface $entity);

  /**
   * The url the device should show if it has nothing else to show.
   *
   * @return string
   */
  public function getDefaultUrl();

  /**
   * The name of the channel the device is currently subscribed to.
   * @return string
   */
  public function getChannelName();

}
