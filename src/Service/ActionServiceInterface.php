<?php
/**
 * Action service interface.
 */

namespace Drupal\signage\Service;

use Drupal\signage\Event\InputEvent;

/**
 * Interface ActionServiceInterface.
 *
 * @package Drupal\signage\Service
 */
interface ActionServiceInterface {

  /**
   * The Actions that are fired due to the input event.
   *
   * @param InputEvent $event
   *
   * @return array of Action
   */
  public function getActionsForInputEvent(InputEvent $event);
}
