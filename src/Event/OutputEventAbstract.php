<?php
namespace Drupal\signage\Event;

use Symfony\Component\EventDispatcher\Event;

abstract class OutputEventAbstract extends Event implements OutputEventInterface {

  protected $channel;

  protected $payload;


  /**
   * @inheritDoc
   */
  public function setChannelName($name) {
    $this->channel = $name;

    return $this;
  }

  /**
   * @inheritDoc
   */
  public function getChannelName() {
    return $this->channel;
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
