<?php

namespace Drupal\signage\Event;

interface OutputEventInterface {

  /**
   * The name to use when dispatching the event.
   * eg; signage.url
   */
  static public function name();

  /**
   * The channel that the event will be sent to.
   * @param string $name
   *
   * @return self
   */
  public function setChannelName($name);

  /**
   * The channel that the event will be sent to.
   * @return string
   */
  public function getChannelName();

  /**
   *
   * @return EventPayload
   */
  public function getPayload();

  /**
   * @param \Drupal\signage\Event\EventPayload $payload
   *
   * @return self
   */
  public function setPayload(EventPayload $payload);
}
