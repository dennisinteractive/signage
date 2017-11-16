<?php
namespace Drupal\signage\Action;

use Drupal\node\NodeInterface;
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

  /**
   * @var NodeInterface
   */
  protected $entity;


  public function __construct(OutputEventFactoryInterface $factory) {
    $this->outputEventFactory = $factory;
  }

  /**
   * @inheritDoc
   */
  public function getId() {
    return (int) $this->entity->id();
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
  public function getInputEvent() {
    return $this->inputEvent;
  }

  /**
   * @inheritDoc
   */
  public function getOutputEvent() {
    //$p = $this->getOutputPayload();
    // Build the new output event eg; UrlEvent
    $event_type = $this->getOutputEventType();
    $oe = $this->outputEventFactory->getEvent($event_type);
    //$oe->setPayload($p);
    $oe->setAction($this);

    return $oe;
  }

  /**
   * The output event class.
   */
  public function getOutputEventType() {
    // Get the referenced output event of the Action.
    $output_tid = $this->getNode()->get('field_signage_do_output_event')->getValue();
    $output_term = \Drupal\taxonomy\Entity\Term::load($output_tid[0]['target_id']);

    // Get the referenced output event type.
    $type_tid = $output_term->get('field_signage_output_event_type')->getValue();
    $type_term = \Drupal\taxonomy\Entity\Term::load($type_tid[0]['target_id']);
    return $type_term->getName();
  }

  /**
   * @inheritDoc
   */
  public function setNode(NodeInterface $entity) {
    $this->entity = $entity;
  }

  /**
   * @inheritDoc
   */
  public function getNode() {
    return $this->entity;
  }

}
