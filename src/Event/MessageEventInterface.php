<?php
namespace Drupal\signage\Event;



interface MessageEventInterface {

  const NAME = 'signage.message';

  /**
   * The message.
   * @return \Drupal\signage\Event\MessageInterface
   */
  public function getMessage();

}
