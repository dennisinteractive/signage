<?php
namespace Drupal\signage\Action;

use Drupal\signage\Event\EventPayload;
use Drupal\signage\Event\InputEvent;
use Drupal\signage\Event\OutputEventFactoryInterface;

class Action implements ActionInterface {

  /**
   * @var \Drupal\signage\Event\InputEvent
   */
  protected $inputEvent;

  /**
   * @var \Drupal\signage\Event\OutputEventFactoryInterface
   */
  protected $outputEventFactory;

  /**
   * @var \Drupal\signage\Event\EventPayload
   */
  protected $payload;

  public function __construct(OutputEventFactoryInterface $factory, EventPayload $payload) {
    $this->outputEventFactory = $factory;
    $this->payload = $payload;
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
    $oe = $this->outputEventFactory->getEvent($event_type);
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
      return 'signage.url';
      //return 'Drupal\signage\Event\UrlEvent';
    }
    else if($this->inputEvent->getSource() == 'demo.input.message') {
      return 'signage.message';
      //return 'Drupal\signage\Event\MessageEvent';
    }
  }

  /**
   * Prepare the output payload.
   */
  public function getOutputPayload() {
    // TODO: Implement getOutputPayload() method.
    // Populate the payload for the output event.

    $vals = $this->inputEvent->getPayload()->getValues();

    // Temp code...
    if ($this->inputEvent->getSource() == 'demo.input.url') {
      $url = $vals['url'] . '?'
        . $vals['key_1'] . '=' . $vals['value_1'] . '&'
        . $vals['key_2'] . '=' . $vals['value_2'];
      $this->payload->setValue('url', $url);
    }
    else if($this->inputEvent->getSource() == 'demo.input.message') {
      $this->payload->setValues($vals);
    }

    return $this->payload;
  }

}
