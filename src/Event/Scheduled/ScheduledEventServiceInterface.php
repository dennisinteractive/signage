<?php

namespace Drupal\signage\Event\Scheduled;

use Drupal\node\Entity\Node;

interface ScheduledEventServiceInterface {

  /**
   * The Actions that are fired due to the scheduled event.
   */
  public function getActions();

  public function processScheduledEvents();

  public function dispatchActions($actions);

  /**
   * Checks for actions whose time it is to run.
   * @param Node $node
   *
   * @return bool
   */
  public function actionDue(Node $node);
}
