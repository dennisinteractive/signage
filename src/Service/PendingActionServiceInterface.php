<?php
/**
 * Pending action service interface.
 *
 * Actions that should happen at a later time.
 * Such as showing the default url after half an hour.
 */

namespace Drupal\signage\Service;

use Drupal\signage\Action\ActionInterface;


/**
 * Interface PendingActionServiceInterface
 *
 * @package Drupal\signage\Service
 */
interface PendingActionServiceInterface {

  /**
   * How many actions are ready to be dispatched.
   *
   * @return integer
   */
  public function numberOfDueActions();

  /**
   * Get the next action that should now be dispatched.
   *
   * @return \Drupal\signage\Action\ActionInterface
   */
  public function getDueAction();

  /**
   * Add an action that should be dispatched later.
   *
   * @param \Drupal\signage\Action\ActionInterface $action
   *
   * @return self
   */
  public function addAction(ActionInterface $action);

}
