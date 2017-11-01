<?php
namespace Drupal\signage\Service;

interface ActionServiceInterface {

  /**
   * The Actions that are fired due to the source event.
   *
   * @param $name
   *
   * @return array of Action
   */
  public function getActionsForSource($name);
}
