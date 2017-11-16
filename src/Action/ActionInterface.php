<?php
namespace Drupal\signage\Action;

use Drupal\node\NodeInterface;
use Drupal\signage\Event\InputEvent;

interface ActionInterface {

  /**
   * The id of the action content type.
   *
   * @return int
   */
  public function getId();

  /**
   * @param \Drupal\signage\Event\InputEvent $event
   *
   * @return self
   */
  public function setInputEvent(InputEvent $event);

  /**
   * @return \Drupal\signage\Event\InputEvent
   */
  public function getInputEvent();

  /**
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
   * @return NodeInterface
   */
  public function getNode();
}
