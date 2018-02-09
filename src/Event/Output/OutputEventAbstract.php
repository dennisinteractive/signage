<?php
/**
 * Base class for output events.
 */

namespace Drupal\signage\Event\Output;

use Drupal\signage\Action\ActionInterface;
use Drupal\signage\Channel\ChannelInterface;
use Drupal\signage\Event\Payload\EventPayloadInterface;
use Symfony\Component\EventDispatcher\Event;

/**
 * Class OutputEventAbstract.
 *
 * @package Drupal\signage\Event
 */
abstract class OutputEventAbstract extends Event implements OutputEventInterface {

  protected $channel;

  protected $action;

  /**
   * @var EventPayloadInterface
   */
  protected $payload;

  protected $channelName;


  /**
   * OutputEventAbstract constructor.
   *
   * @param EventPayloadInterface $payload
   */
  public function __construct(EventPayloadInterface $payload) {
    $this->setPayload($payload);
  }

  /**
   * @inheritDoc
   */
  public function setChannel(ChannelInterface $channel) {
    $this->channel = $channel;
    //$this->channelName = $channel->getName();

    return $this;
  }

  /**
   * @inheritDoc
   */
  public function getChannel() {
    return $this->channel;
  }

//  public function getChannelName() {
//    return $this->channelName;
//  }

  /**
   * @inheritDoc
   */
  public function setAction(ActionInterface $action) {
    $this->action = $action;
    $this->populatePayload();

    return $this;
  }

  /**
   * @inheritDoc
   */
  public function getAction() {
    if (!is_null($this->action)) {
      return $this->action;
    }

    throw new \InvalidArgumentException('No action set.');
  }

  /**
   * @inheritdoc
   */
  public function hasAction() {
    if ($this->action instanceof ActionInterface) {
      return TRUE;
    }
    return FALSE;
  }
  /**
   * @inheritDoc
   */
  public function getPayload() {
    return $this->payload;
  }

  /**
   * @inheritDoc
   */
  public function setPayload(EventPayloadInterface $payload) {
    $this->payload = $payload;

    return $this;
  }

}
