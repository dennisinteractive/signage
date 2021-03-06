<?php
/**
 * Wrapper for the Drupal device content type.
 */

namespace Drupal\signage\Device;

use Drupal\Core\Entity\EntityInterface;
use Drupal\node\NodeInterface;
use Drupal\signage\Channel\ChannelInterface;

/**
 * Class Device.
 *
 * @package Drupal\signage\Device
 */
class Device implements DeviceInterface {

  /**
   * The drupal node.
   *
   * @var NodeInterface
   */
  protected $entity;

  /**
   * The channel.
   *
   * @var \Drupal\signage\Channel\ChannelInterface
   */
  protected $channel;

  /**
   * Device constructor.
   *
   * @param \Drupal\signage\Channel\ChannelInterface $channel
   */
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
  public function setNode(EntityInterface $entity) {
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
  public function getChannel() {
    if (empty($this->channel->getNode())) {
      // Get the drupal channel node.
      if (!empty($field_signage_channel = $this->entity->get('field_signage_channel')->getValue())) {
        $nid = $field_signage_channel[0]['target_id'];
        $node = \Drupal\node\Entity\Node::load($nid);
        if (isset($node)) {
          $this->channel->setNode($node);
        }
      }
    }

    return $this->channel;
  }
}
