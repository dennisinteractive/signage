<?php
namespace Drupal\signage\Action;

use Drupal\signage\Event\InputEvent;

interface ActionInterface {

  /**
   * The id of the action content type.
   *
   * @return int
   */
  public function getId();

  /**
   * @param \Drupal\signage\Event\InputEvent $event
   *
   * @return self
   */
  public function setInputEvent(InputEvent $event);

  /**
   * @return \Drupal\signage\Event\OutputEventInterface
   */
  public function getOutputEvent();
}
