<?php
/**
 * Message output event interface.
 */

namespace Drupal\signage\Event\Output;


interface MessageEventInterface extends OutputEventInterface {

  const NAME = 'signage.message';

  /**
   * The message.
   * @return MessageInterface
   */
  public function getMessage();

}
