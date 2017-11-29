<?php
/**
 * Interface for the Drupal content type wrapper.
 */

namespace Drupal\signage\Channel;

use Drupal\node\NodeInterface;
use Drupal\signage\Event\OutputEventInterface;

/**
 * Interface ChannelInterface.
 *
 * @package Drupal\signage\Channel
 */
interface ChannelInterface {

  /**
   * The id of the channel.
   *
   * @return int
   */
  public function getId();

  /**
   * The channel name.
   *
   * @return string
   */
  public function getName();

  /**
   * The default url.
   *
   * @return string
   */
  public function getDefaultUrl();

  /**
   * The drupal entity, as returned by node_load().
   *
   * @param $entity
   *
   * @return self
   */
  public function setNode(NodeInterface $entity);

  /**
   * The Drupal node.
   *
   * @return NodeInterface
   */
  public function getNode();

  /**
   * Stores the dispatched output event, so the channel knows its current state.
   *
   * @param \Drupal\signage\Event\OutputEventInterface $event
   *
   * @return mixed
   */
  public function dispached(OutputEventInterface $event);

  /**
   * The dispatched data.
   *
   * @return array
   */
  public function getDispatched();

  /**
   * Removes the channel from the system.
   *
   * @return boolean
   */
  public function delete();
}
