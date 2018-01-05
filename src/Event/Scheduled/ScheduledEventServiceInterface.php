<?php

namespace Drupal\signage\Event\Scheduled;

interface ScheduledEventServiceInterface {

  /**
   * The Actions that are fired due to the scheduled event.
   */
  public function getActions();

  public function processScheduledEvents();

  public function dispatchActions($actions);
}
