<?php
/**
 * Interface for the Drupal content type wrapper.
 */

namespace Drupal\signage\Channel;

use Drupal\Core\State\StateInterface;
use Drupal\node\NodeInterface;
use Drupal\signage\Event\Output\OutputEventInterface;

/**
 * Interface ChannelInterface.
 *
 * @package Drupal\signage\Channel
 */
interface ChannelInterface {

  /**
   * Allow the channel to be serialized but removing the drupal state.
   *
   * @return self
   */
  public function unsetSate();

  /**
   * Allows the sytem to keep track of the channel status.
   *
   * @param \Drupal\Core\State\StateInterface $state
   *
   * @return self
   */
  public function setState(StateInterface $state);

  /**
   * @return StateInterface
   */
  public function getState();

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
   * The url the channel is currently displaying.
   *
   * @return string
   */
  public function getCurrentUrl();

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
   * @param OutputEventInterface $event
   *
   * @return mixed
   */
  public function dispatched(OutputEventInterface $event);

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
