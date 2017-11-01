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
   * @return \Drupal\signage\Event\OutputEventInterface
   */
  public function getOutputEvent();
}
