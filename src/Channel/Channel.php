<?php
namespace Drupal\signage\Channel;


use Drupal\Core\State\StateInterface;
use Drupal\node\NodeInterface;
use Drupal\signage\Event\OutputEventInterface;

class Channel implements ChannelInterface {

  /**
   * @var \Drupal\Core\State\StateInterface
   */
  protected $state;

  /**
   * @var NodeInterface
   */
  protected $entity;

  /**
   * Channel constructor.
   *
   * @param \Drupal\Core\State\StateInterface $state
   */
  public function __construct(StateInterface $state) {
    $this->state = $state;
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
  public function getName() {
    return $this->entity->getTitle();
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
  public function addOutputEvent(OutputEventInterface $event) {
    // Only one of each time of output event can be active at a time.
    // Merge with existing events.
    $data = $this->getOutputEvents();
    $data[$event::name()] = $event;
    $this->state->set($this->getStateKey(), serialize($data));
  }

  /**
   * @inheritDoc
   */
  public function getOutputEvents() {
    $data = $this->state->get($this->getStateKey());
    if (!$data) {
      // Nothing stored for this channel.
      return [];
    }

    return unserialize($data);
  }

  /**
   * @inheritDoc
   */
  public function delete() {
    $this->state->delete($this->getStateKey());
  }

  protected function getStateKey() {
    return 'signage.channel.' . $this->getId();
  }

}
