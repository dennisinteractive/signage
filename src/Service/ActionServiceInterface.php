<?php
namespace Drupal\signage\Service;

use Drupal\signage\Event\InputEvent;

interface ActionServiceInterface {

  /**
   * The Actions that are fired due to the input event.
   *
   * @param $event InputEvent
   *
   * @return array of Action
   */
  public function getActionsForInputEvent(InputEvent $event);
}
