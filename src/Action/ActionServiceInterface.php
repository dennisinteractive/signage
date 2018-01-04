<?php
/**
 * Action service interface.
 */

namespace Drupal\signage\Action;

use Drupal\signage\Event\Input\InputEvent;

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
   */
  public function getActionsForInputEvent(InputEvent $event);
}
