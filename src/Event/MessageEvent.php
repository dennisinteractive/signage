<?php
namespace Drupal\signage\Event;

use Symfony\Component\EventDispatcher\Event;

class MessageEvent extends OutputEventAbstract implements OutputEventInterface {

  const NAME = 'signage.message';

  /**
   * @var \Drupal\signage\Event\Message
   */
  protected $message;

  /**
   * MessageEvent constructor.
   *
   * @param \Drupal\signage\Event\Message $message
   */
  public function __construct(Message $message) {
    $this->message = $message;
  }

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
    $this->message->setTitle($vals['title'])
      ->setBody($vals['body'])
      ->setNotificationType($vals['notification_type'])
      ->setTimeout($vals['time_out'])
    ;
    return $this->message;
  }

}
