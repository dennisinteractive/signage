<?php

namespace Drupal\signage\Event;

interface InputEventInterface {

  /**
   * The source event name.
   * eg; jenkins.deployment.successful
   * @return string
   */
  public function getSource();

  /**
   * @param $name
   *
   * @return self
   */
  public function setSource($name);

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
}
