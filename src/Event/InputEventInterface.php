<?php

namespace Drupal\signage\Event;

interface InputEventInterface {

  /**
   * The module/input that created the event.
   * eg; Jenkins, GitHub etc
   *
   * @return string
   */
  public function getSourceName();

  /**
   * @param $name
   *
   * @return self
   */
  public function setSourceName($name);

  /**
   * The source event name.
   * eg; site-deployment-successful
   * @return string
   */
  public function getSourceEventName();

  /**
   * @param $name
   *
   * @return self
   */
  public function setSourceEventName($name);

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
