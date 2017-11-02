<?php
namespace Drupal\signage\Action;

use Drupal\signage\Event\EventPayload;
use Drupal\signage\Event\InputEvent;

class Action implements ActionInterface {

  /**
   * @var \Drupal\signage\Event\InputEvent
   */
  protected $inputEvent;

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
  public function setInputEvent(InputEvent $event) {
    $this->inputEvent = $event;

    return $this;
  }

  /**
   * @inheritDoc
   */
  public function getOutputEvent() {
    $p = $this->getOutputPayload();
    // Build the new output event eg; UrlEvent
    $event_type = $this->getOutputEventType();
    //$eventService = \Drupal::service('signage.event.<url>.service');
    $oe = new $event_type();
    $oe->setPayload($p);

    return $oe;
  }

  /**
   * The output event class.
   */
  public function getOutputEventType() {
    // TODO: Implement getOutputEventType() method.

    // Temp code...
    if ($this->inputEvent->getSource() == 'demo.input.url') {
      return 'Drupal\signage\Event\UrlEvent';
    }
    else if($this->inputEvent->getSource() == 'demo.input.message') {
      return 'Drupal\signage\Event\MessageEvent';
    }
  }

  /**
   * Prepare the output payload.
   */
  public function getOutputPayload() {
    // TODO: Implement getOutputPayload() method.
    // Build the payload for the output event.
    $p = new EventPayload();
    $vals = $this->inputEvent->getPayload()->getValues();

    // Temp code...
    if ($this->inputEvent->getSource() == 'demo.input.url') {
      $url = $vals['url'] . '?'
        . $vals['key_1'] . '=' . $vals['value_1'] . '&'
        . $vals['key_2'] . '=' . $vals['value_2'];
      $p->setValue('url', $url);
    }
    else if($this->inputEvent->getSource() == 'demo.input.message') {
      $p->setValues($vals);
    }

    return $p;
  }

}
