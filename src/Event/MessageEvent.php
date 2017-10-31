<?php
namespace Drupal\signage\Event;

use Symfony\Component\EventDispatcher\Event;

class MessageEvent extends OutputEventAbstract implements OutputEventInterface {

  const NAME = 'signage.message';

  /**
   * @inheritDoc
   */
  static public function name() {
    return self::NAME;
  }

  /**
   * The message.
   * @return string
   * @todo Message class as a message is more than just a string.
   */
  public function getMessage() {
    $vals = $this->getPayload()->getValues();
    return reset($vals);
  }

}
