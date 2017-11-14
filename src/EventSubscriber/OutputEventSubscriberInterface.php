<?php

namespace Drupal\signage\EventSubscriber;

use Drupal\signage\Event\OutputEventInterface;

interface OutputEventSubscriberInterface  {

  /**
   * Inform the channel about the output event.
   *
   * @param \Drupal\signage\Event\OutputEventInterface $event
   *
   * @return self
   */
  public function updateChannel(OutputEventInterface $event);
}
