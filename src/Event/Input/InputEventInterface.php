<?php
/**
 * The url input event interface.
 */

namespace Drupal\signage\Event\Input;

use Drupal\signage\Event\Payload\EventPayloadInterface;

/**
 * Interface InputEventInterface.
 *
 * @package Drupal\signage\Event
 */
interface InputEventInterface {

  /**
   * The source event name, eg; jenkins.deployment.successful.
   *
   * @return string
   */
  public function getSource();

  /**
   * Sets the source name, eg; jenkins.deployment.successful.
   * @param $name
   *
   * @return self
   */
  public function setSource($name);

  /**
   * Gets the event payload.
   *
   * @return EventPayloadInterface
   */
  public function getPayload();

  /**
   * Sets the event payload.
   * @param EventPayloadInterface $payload
   *
   * @return self
   */
  public function setPayload(EventPayloadInterface $payload);
}
