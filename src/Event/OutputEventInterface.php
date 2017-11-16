<?php

namespace Drupal\signage\Event;

use Drupal\signage\Action\ActionInterface;
use Drupal\signage\Channel\ChannelInterface;

interface OutputEventInterface {

  /**
   * The name to use when dispatching the event.
   * eg; signage.url
   */
  static public function name();

  /**
   * The channel that the event will be sent to.
   * @param ChannelInterface $channel
   *
   * @return self
   */
  public function setChannel(ChannelInterface $channel);

  /**
   * The channel that the event will be sent to.
   * @return ChannelInterface
   */
  public function getChannel();

  /**
   * @param \Drupal\signage\Action\ActionInterface $action
   *
   * @return mixed
   */
  public function setAction(ActionInterface $action);

  /**
   * @return \Drupal\signage\Action\ActionInterface
   */
  public function getAction();

  /**
   *
   * @return EventPayload
   */
  public function getPayload();

  /**
   * @param \Drupal\signage\Event\EventPayloadInterface $payload
   *
   * @return self
   */
  public function setPayload(EventPayloadInterface $payload);

  /**
   * Populates the payload with data from the incoming event.
   * @return self
   */
  public function populatePayload();
}
