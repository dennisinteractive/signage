<?php
/**
 * Base class for output events.
 */

namespace Drupal\signage\Event;

use Drupal\Core\DependencyInjection\DependencySerializationTrait;
use Drupal\signage\Action\ActionInterface;
use Drupal\signage\Channel\ChannelInterface;
use Symfony\Component\EventDispatcher\Event;

/**
 * Class OutputEventAbstract.
 *
 * @package Drupal\signage\Event
 */
abstract class OutputEventAbstract extends Event implements OutputEventInterface {
  /**
   * Make the event serializable.
   */
  use DependencySerializationTrait;

  protected $channel;

  protected $action;

  /**
   * @var \Drupal\signage\Event\EventPayload
   */
  protected $payload;


  /**
   * OutputEventAbstract constructor.
   *
   * @param \Drupal\signage\Event\EventPayloadInterface $payload
   */
  public function __construct(EventPayloadInterface $payload) {
    $this->setPayload($payload);
  }

  /**
   * @inheritDoc
   */
  public function setChannel(ChannelInterface $channel) {
    $this->channel = $channel;

    return $this;
  }

  /**
   * @inheritDoc
   */
  public function getChannel() {
    return $this->channel;
  }

  /**
   * @inheritDoc
   */
  public function setAction(ActionInterface $action) {
    $this->action = $action;

    return $this;
  }

  /**
   * @inheritDoc
   */
  public function getAction() {
    return $this->action;
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
