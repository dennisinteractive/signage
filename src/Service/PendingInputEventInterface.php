<?php
/**
 * Pending input event service interface.
 *
 * Input events that should happen at a later time.
 * Such as showing the default url after half an hour.
 */
namespace Drupal\signage\Service;

use Drupal\signage\Event\InputEventInterface;


/**
 * Interface PendingInputEventInterface
 *
 * @package Drupal\signage\Service
 */
interface PendingInputEventInterface {

  /**
   * Add an event that should be dispatched later.
   *
   * @param InputEventInterface $event
   *  The event that will be dispatched later.
   * @param integer $due
   *  The timestamp when the action should be dispatched.
   *
   * @return self
   */
  public function addInputEvent(InputEventInterface $event, $due);

}
