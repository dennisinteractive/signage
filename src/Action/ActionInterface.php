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
   * The field names with their values of the action content.
   * @return array of key value pairs
   */
  public function getFields();
}
