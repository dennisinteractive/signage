<?php
/**
 * The output event interface.
 */

namespace Drupal\signage\Event\Output;

use Drupal\signage\Action\ActionInterface;
use Drupal\signage\Channel\ChannelInterface;
use Drupal\signage\Event\Payload\EventPayloadInterface;

/**
 * Interface OutputEventInterface.
 *
 * @package Drupal\signage\Event
 */
interface OutputEventInterface {

  /**
   * The name to use when dispatching the event, eg; signage.url.
   */
  static public function name();

  /**
   * The channel that the event will be sent to.
   *
   * @param ChannelInterface $channel
   *
   * @return self
   */
  public function setChannel(ChannelInterface $channel);

  /**
   * The channel that the event will be sent to.
   *
   * @return ChannelInterface
   */
  public function getChannel();

  /**
   * Sets the Action that called the event.
   *
   * @param \Drupal\signage\Action\ActionInterface $action
   *
   * @return mixed
   */
  public function setAction(ActionInterface $action);

  /**
   * Gets the Action that called the event.
   *
   * @return \Drupal\signage\Action\ActionInterface
   */
  public function getAction();

  /**
   * Gets the event payload.
   *
   * @return EventPayloadInterface
   */
  public function getPayload();

  /**
   * Sets the event payload.
   *
   * @param EventPayloadInterface $payload
   *
   * @return self
   */
  public function setPayload(EventPayloadInterface $payload);

  /**
   * Populates the payload with data from the incoming event.
   *
   * @return self
   */
  public function populatePayload();
}
