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

  public function setId($id);

  /**
   * The channel name.
   *
   * @return string
   */
  public function getName();

  public function setName($name);

  /**
   * The default url.
   *
   * @return string
   */
  public function getDefaultUrl();

  public function setDefaultUrl($url);

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
   * So the channel can be serialized.
   * @return self
   */
  public function unsetNode();

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
