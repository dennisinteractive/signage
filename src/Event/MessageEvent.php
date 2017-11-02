<?php
namespace Drupal\signage\Event;

use Symfony\Component\EventDispatcher\Event;

class MessageEvent extends OutputEventAbstract implements OutputEventInterface {

  const NAME = 'signage.message';

  /**
   * @var \Drupal\signage\Event\MessageInterface
   */
  protected $message;

  /**
   * MessageEvent constructor.
   *
   * @param \Drupal\signage\Event\MessageInterface $message
   */
  public function __construct(MessageInterface $message) {
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
