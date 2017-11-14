<?php
namespace Drupal\signage\Channel;

use Drupal\Core\State\StateInterface;
use Drupal\signage\Event\OutputEventInterface;

class Channel implements ChannelInterface {

  /**
   * @var \Drupal\Core\State\StateInterface
   */
  protected $state;

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
    // TODO: Implement getId() method.
    return 1;
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
