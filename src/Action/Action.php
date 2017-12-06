<?php
/**
 * Wrapper for the Drupal action content type.
 */

namespace Drupal\signage\Action;

use Drupal\node\NodeInterface;
use Drupal\signage\Event\InputEventInterface;
use Drupal\signage\Event\OutputEventFactoryInterface;

/**
 * Class Action.
 *
 * @package Drupal\signage\Action
 */
class Action implements ActionInterface {

  protected $maxTime;

  protected $minTime;

  /**
   * The input event.
   *
   * @var \Drupal\signage\Event\InputEvent
   */
  protected $inputEvent;

  /**
   * The output event factory.
   *
   * @var \Drupal\signage\Event\OutputEventFactoryInterface
   */
  protected $outputEventFactory;

  /**
   * The event payload.
   *
   * @var \Drupal\signage\Event\EventPayload
   */
  protected $payload;

  /**
   * The action node.
   *
   * @var NodeInterface
   */
  protected $entity;

  /**
   * Action constructor.
   *
   * @param \Drupal\signage\Event\OutputEventFactoryInterface $factory
   */
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
  public function setInputEvent(InputEventInterface $event) {
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

  /**
   * @inheritDoc
   */
  public function unsetNode() {
    unset($this->entity);
    return $this;
  }

  /**
   * @inheritDoc
   */
  public function getMinimumTime() {
    // TODO: Implement getMinimumTime() method.
  }

  /**
   * @inheritDoc
   */
  public function getMaximumTime() {
    // TODO: Implement getMaximumTime() method.
  }

  public function setMinimumTime($int) {
    $this->minTime = $int;
    return $this;
  }

  public function setMaximumTime($int) {
    $this->maxTime = $int;
    return $this;
  }


}
