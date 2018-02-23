<?php

namespace Drupal\signage\Event\Scheduled;

interface ScheduledEventServiceInterface {

  /**
   * The Actions that are fired due to the scheduled event.
   */
  public function getActions();

  /**
   * Process scheduled actions.
   *
   * @return mixed
   */
  public function processScheduledEvents();

  /**
   * Dispatch the scheduled actions.
   *
   * @param $actions
   *
   * @return mixed
   */
  public function dispatchActions($actions);

  /**
   * Check if the action is due.
   *
   * @param $node
   *
   * @return boolean
   */
  public function actionDue($node);

}
