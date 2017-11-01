<?php
namespace Drupal\signage\Action;

interface ActionInterface {

  /**
   * The id of the action content type.
   *
   * @return int
   */
  public function getId();

  /**
   * The event type to be dispatched
   * @return string
   */
  public function getOutputEventType();

  /**
   * @return \Drupal\signage\Event\EventPayload
   */
  public function getOutputPayload();
}
