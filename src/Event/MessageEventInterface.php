<?php
/**
 * Message output event interface.
 */

namespace Drupal\signage\Event;


interface MessageEventInterface extends OutputEventInterface {

  const NAME = 'signage.message';

  /**
   * The message.
   * @return \Drupal\signage\Event\MessageInterface
   */
  public function getMessage();

}
