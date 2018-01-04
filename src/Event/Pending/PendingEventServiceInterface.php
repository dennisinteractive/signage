<?php
/**
 * Pending action service interface.
 *
 * Actions that should happen at a later time.
 * Such as showing the default url after half an hour.
 */

namespace Drupal\signage\Event\Pending;

use Drupal\signage\Event\Output\OutputEventInterface;


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

  /**
   * Dispatch items that are due.
   */
  public function processQueue();

}
