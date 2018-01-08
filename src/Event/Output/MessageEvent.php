<?php
/**
 * Message output event.
 */

namespace Drupal\signage\Event\Output;

use Drupal\signage\Action\Action;
use Drupal\signage\Event\Payload\EventPayloadInterface;
use Drupal\signage\Message\MessageInterface;


/**
 * Class MessageEvent.
 *
 * @package Drupal\signage\Event
 */
class MessageEvent extends OutputEventAbstract implements MessageEventInterface {

  /**
   * @var MessageInterface
   */
  protected $message;

  /**
   * MessageEvent constructor.
   *
   * @param EventPayloadInterface $payload
   * @param MessageInterface $message
   */
  public function __construct(EventPayloadInterface $payload, MessageInterface $message) {
    parent::__construct($payload);
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
   * @return MessageInterface
   */
  public function getMessage() {
    $this->populatePayload()->getPayload();
//    $vals = $this->populatePayload()->getPayload()->getValues();
//
//
//
//
//    $this->message->setTitle($vals['title'])
//      ->setBody($vals['body'])
//      ->setNotificationType($vals['notification_type'])
//      ->setTimeout($vals['time_out'])
//    ;
    return $this->message;
  }

  /**
   * @inheritDoc
   */
  public function populatePayload() {
    // If the action has been set use its input payload for values.
    $action = $this->getAction();
    if ($action instanceof Action) {
      // Get the payload key value pairs.
      $vals = $action->getInputEvent()->getPayload()->getValues();
      $this->getPayload()->setValues($vals);


      // Get the referenced output event of the Action.
      $output_tid = $this->getAction()->getNode()->get('field_signage_do_output_event')->getValue();
      $output_term = \Drupal\taxonomy\Entity\Term::load($output_tid[0]['target_id']);
      // The description field has the content that is to be sent out,
      // but needs values replacing
      $description = $output_term->get('description')->getValue();
      $value = trim(strip_tags($description[0]['value']));

      // Replace the placeholders with their values from the payload.
      foreach ($vals as $k => $v) {
        $value = str_replace("[$k]", $v, $value);
      }

      // Currently the description field has the message parts in json.
      // the UI however puts crap in the json like <br/>, <p> & &nbsp;
      $json_vals = json_decode(str_replace('&nbsp;', '', strip_tags($value)));
      $this->message->setTitle($json_vals->title)
        ->setBody($json_vals->body)
        ->setNotificationType($json_vals->notification_type)
        ->setTimeout($json_vals->timeout)
      ;

    }

    return $this;
  }

}
