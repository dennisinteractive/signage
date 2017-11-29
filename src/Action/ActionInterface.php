<?php
/**
 * Interface for the Drupal content type wrapper.
 */

namespace Drupal\signage\Action;

use Drupal\node\NodeInterface;
use Drupal\signage\Event\InputEvent;

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
   * @param \Drupal\signage\Event\InputEvent $event
   *
   * @return self
   */
  public function setInputEvent(InputEvent $event);

  /**
   * The input event.
   *
   * @return \Drupal\signage\Event\InputEvent
   */
  public function getInputEvent();

  /**
   * The output event.
   *
   * @return \Drupal\signage\Event\OutputEventInterface
   */
  public function getOutputEvent();

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
}
