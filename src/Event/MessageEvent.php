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
   * @return \Drupal\signage\Event\Message
   */
  public function getMessage() {
    $vals = $this->getPayload()->getValues();
    $m = new Message();
    $m->setTitle($vals['title'])
      ->setBody($vals['body'])
      ->setNotificationType($vals['notification_type'])
      ->setTimeout($vals['time_out'])
    ;
    return $m;
  }

}
