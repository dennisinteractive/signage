<?php
/**
 * Pending action service interface.
 *
 * Actions that should happen at a later time.
 * Such as showing the default url after half an hour.
 */

namespace Drupal\signage\Service;

use Drupal\signage\Action\ActionInterface;
use Drupal\signage\Event\OutputEventInterface;


/**
 * Interface PendingEventServiceInterface
 *
 * @package Drupal\signage\Service
 */
interface PendingEventServiceInterface {

  /**
   * How many events are ready to be dispatched.
   *
   * @return integer
   */
  public function numberDue();

  /**
   * Get the next event that should now be dispatched.
   *
   * @return OutputEventInterface
   */
  public function getNextDue();

  /**
   * Add an event that should be dispatched later.
   *
   * @param OutputEventInterface $event
   *  The event that will be dispatched later.
   * @param integer $due
   *  The timestamp when the action should be dispatched.
   *
   * @return self
   */
  public function addEvent(OutputEventInterface $event, $due);

}
