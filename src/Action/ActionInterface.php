<?php
/**
 * Interface for the Drupal content type wrapper.
 */

namespace Drupal\signage\Action;

use Drupal\node\NodeInterface;
use Drupal\signage\Event\Input\InputEventInterface;


/**
 * Interface ActionInterface.
 *
 * @package Drupal\signage\Action
 */
interface ActionInterface {

  /**
   * The id of the action content type.
   *
   * @return int
   */
  public function getId();

  /**
   * Set the input event.
   *
   * @param InputEventInterface $event
   *
   * @return self
   */
  public function setInputEvent(InputEventInterface $event);

  /**
   * The input event.
   *
   * @return InputEventInterface
   */
  public function getInputEvent();

  /**
   * The output event.
   *
   * @return OutputEventInterface
   */
  public function getOutputEvent();

  /**
   * The drupal entity, as returned by node_load().
   *
   * @param NodeInterface $entity
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
   * Number of seconds until which all other actions of the same type must be ignored.
   *
   * @return integer
   */
  public function getMinimumTime();

  public function setMinimumTime($int);

  /**
   * Number of seconds after which the action should be cleared.
   *
   * @return integer
   */
  public function getMaximumTime();

  public function setMaximumTime($int);

  /**
   * @return array
   */
  public function toArray();

}
