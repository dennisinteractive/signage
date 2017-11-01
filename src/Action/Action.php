<?php
namespace Drupal\signage\Action;

use Drupal\signage\Event\InputEvent;

class Action implements ActionInterface {

  /**
   * @var \Drupal\signage\Event\InputEvent
   */
  protected $inputEvent;

  /**
   * Action constructor.
   *
   * @param \Drupal\signage\Event\InputEvent $event
   */
  public function __construct(InputEvent $event) {
    $this->inputEvent = $event;
  }

  /**
   * @inheritDoc
   */
  public function getId() {
    // TODO: Implement getId() method.
    return 1;
  }

  /**
   * @inheritDoc
   */
  public function getOutputEventType() {
    // TODO: Implement getOutputEventType() method.
    return 'Drupal\signage\Event\UrlEvent';
  }

  /**
   * @inheritDoc
   */
  public function getValues() {
    // TODO: Implement getFields() method.
    $vals = $this->inputEvent->getPayload()->getValues();
    $url = $vals['url'] . '?'
      . $vals['key_1'] . '=' . $vals['value_1'] . '&'
      . $vals['key_2'] . '=' . $vals['value_2']
    ;
    return ['url' => $url];
  }

}