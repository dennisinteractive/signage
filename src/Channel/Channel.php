<?php
/**
 * Wrapper for the Drupal channel content type.
 */

namespace Drupal\signage\Channel;

use Drupal\Core\State\StateInterface;
use Drupal\node\NodeInterface;
use Drupal\signage\Action\ActionInterface;
use Drupal\signage\Event\Output\OutputEventInterface;

/**
 * Class Channel.
 *
 * @package Drupal\signage\Channel
 */
class Channel implements ChannelInterface {

  /**
   * @var \Drupal\Core\State\StateInterface
   */
  protected $state;

  /**
   * @var NodeInterface
   */
  protected $entity;

  protected $id;

  protected $name;

  protected $defaultUrl;

  /**
   * @inheritDoc
   */
  public function unsetSate() {
    unset($this->state);
    return $this;
  }

  /**
   * @inheritDoc
   */
  public function setState(StateInterface $state) {
    $this->state = $state;
    return $this;
  }

  /**
   * @inheritDoc
   */
  public function getState() {
    return $this->state;
  }

  /**
   * @inheritDoc
   */
  public function getId() {
    return $this->id;
  }

  /**
   * @inheritDoc
   */
  public function setId($id) {
    $this->id = $id;
    return $this;
  }

  /**
   * @inheritDoc
   */
  public function getName() {
    return $this->name;
  }

  /**
   * @inheritDoc
   */
  public function setName($name) {
    $this->name = $name;
    return $this;
  }

  /**
   * @inheritDoc
   */
  public function getDefaultUrl() {
    return $this->defaultUrl;
  }

  /**
   * @inheritDoc
   */
  public function setDefaultUrl($url) {
    $this->defaultUrl = $url;
    return $this;
  }

  /**
   * @inheritDoc
   */
  public function getCurrentUrl() {
    // Read the state to get the current url.
    $data = $this->getDispatched();
    if (isset($data['signage.url']['payload'])) {
      $payload = $data['signage.url']['payload'];
      return $payload->getValue(0);
    }

    // No state so send the default.
    return $this->getDefaultUrl();
  }

  /**
   * @inheritDoc
   */
  public function getCurrentActionMinTime(ActionInterface $action) {
    $event = $action->getOutputEvent();
    $event_name = $event::name();

    $data = $this->getDispatched();
    if (isset($data[$event_name])) {
      $action_data = $data[$event_name]['action'];
      if (isset($action_data['field_signage_minimum_time'][0])) {
        $min = (int) $action_data['field_signage_minimum_time'][0]["value"];
        $dispatched_time = $data[$event_name]['timestamp'];
        // Add the minimum display time to the time it was dispatched.
        $clear_time = $dispatched_time + ($min * 60);
        $now = time();
        // Check whether the minimum time has passed.
        if ($clear_time > $now) {
          return $clear_time - $now;
        }
      }
    }

    // No minimum time in effect.
    return 0;
  }

  /**
   * @inheritDoc
   */
  public function setNode(NodeInterface $entity) {
    $this->entity = $entity;
    $this->setId($this->entity->id());
    $this->setName($this->entity->getTitle());
    if (isset($this->entity->get('field_signage_default_url')->getValue()[0]['value'])) {
      $this->setDefaultUrl(
        $this->entity->get('field_signage_default_url')->getValue()[0]['value']
      );
    }

    return $this;
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
  public function dispatched(OutputEventInterface $event) {
    $data = $this->getDispatched();
    $action = '';

    if (!is_null($event->hasAction())) {
      $action = $event->getAction()->toArray();
    }

    $state = [
      'event_name' => $event::name(),
      'action' => $action,
      'channel' => $event->getChannel()->toArray(),
      'payload' => $event->getPayload(),
      'timestamp' => time(),
    ];

    // Only one of each type of output event can be active at a time.
    $data[$event::name()] = $state;
    $this->getState()->set($this->getStateKey(), $data);
  }

  /**
   * @inheritDoc
   */
  public function getDispatched() {
    $data = $this->getState()->get($this->getStateKey());
    if (!$data) {
      // Nothing stored for this channel.
      return [];
    }

    return $data;
  }

  /**
   * @inheritDoc
   */
  public function delete() {
    $this->getState()->delete($this->getStateKey());
  }

  /**
   * @inheritDoc
   */
  public function toArray() {
    return $this->getNode()->toArray();
  }

  protected function getStateKey() {
    return 'signage.channel.' . $this->getId();
  }

}
