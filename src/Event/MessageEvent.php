<?php
/**
 * Message output event.
 */

namespace Drupal\signage\Event;


/**
 * Class MessageEvent.
 *
 * @package Drupal\signage\Event
 */
class MessageEvent extends OutputEventAbstract implements MessageEventInterface {

  /**
   * @var \Drupal\signage\Event\MessageInterface
   */
  protected $message;

  /**
   * MessageEvent constructor.
   *
   * @param \Drupal\signage\Event\EventPayloadInterface $payload
   * @param \Drupal\signage\Event\MessageInterface $message
   */
  public function __construct(EventPayloadInterface $payload, MessageInterface $message) {
    parent::__construct($payload);
    $this->message = $message;
  }

  /**
   * The message.
   * @return \Drupal\signage\Event\MessageInterface
   */
  public function getMessage() {
    $vals = $this->populatePayload()->getPayload()->getValues();
    $this->message->setTitle($vals['title'])
      ->setBody($vals['body'])
      ->setNotificationType($vals['notification_type'])
      ->setTimeout($vals['time_out'])
    ;
    return $this->message;
  }

  /**
   * @inheritDoc
   */
  public function populatePayload() {
    // Get the payload key value pairs.
    $vals = $this->getAction()->getInputEvent()->getPayload()->getValues();
    $this->getPayload()->setValues($vals);

    return $this;
  }

}
