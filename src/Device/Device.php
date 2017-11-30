<?php
/**
 * Wrapper for the Drupal device content type.
 */

namespace Drupal\signage\Device;

use Drupal\node\NodeInterface;
use Drupal\signage\Channel\ChannelInterface;

/**
 * Class Device.
 *
 * @package Drupal\signage\Device
 */
class Device implements DeviceInterface {

  /**
   * @var NodeInterface
   */
  protected $entity;

  /**
   * @var \Drupal\signage\Channel\ChannelInterface
   */
  protected $channel;

  public function __construct(ChannelInterface $channel) {
    $this->channel = $channel;
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
  public function getDefaultUrl() {
    return $this->getChannel()->getDefaultUrl();
  }

  /**
   * @inheritDoc
   */
  public function getChannelName() {
    return $this->getChannel()->getName();
  }

  protected function getChannel() {
    if (empty($this->channel->getNode())) {
      // Get the drupal channel node.
      $nid = $this->entity->get('field_signage_channel')->getValue()[0]['target_id'];
      $node = \Drupal\node\Entity\Node::load($nid);
      $this->channel->setNode($node);
    }

    return $this->channel;
  }
}
