<?php
namespace Drupal\signage\Channel;

use Drupal\node\NodeInterface;
use Drupal\signage\Event\OutputEventInterface;

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
   * The drupal entity, as returned by node_load().
   *
   * @param $entity
   *
   * @return self
   */
  public function setNode(NodeInterface $entity);

  public function getNode();

  /**
   * Stores the output event, so the channel knows its current state.
   *
   * @param \Drupal\signage\Event\OutputEventInterface $event
   *
   * @return mixed
   */
  public function addOutputEvent(OutputEventInterface $event);

  /**
   * @return array
   */
  public function getOutputEvents();

  /**
   * Removes the channel from the system.
   *
   * @return boolean
   */
  public function delete();
}
