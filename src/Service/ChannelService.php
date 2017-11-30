<?php
/**
 * Service for Channels.
 */

namespace Drupal\signage\Service;

use Drupal\signage\Channel\ChannelInterface;

/**
 * Class ChannelService.
 *
 * @package Drupal\signage\Service
 */
class ChannelService implements ChannelServiceInterface {

  /**
   * ChannelService constructor.
   *
   * @param \Drupal\signage\Channel\ChannelInterface $channel
   */
  public function __construct(ChannelInterface $channel) {
    // An empty channel ready for cloning.
    $this->channel = $channel;
  }

  /**
   * @inheritDoc
   */
  public function getChannelsForActionId($id) {
    // Find channel content with the action entity id
    // in field_signage_actions
    $query = \Drupal::entityQuery('node')
      ->condition('field_signage_actions', $id)
    ;
    $rows = $query->execute();
    $channels = [];
    foreach ($rows as $row) {
      $channel = clone $this->channel;
      $node =  \Drupal\node\Entity\Node::load($row);
      $channel->setNode($node);
      $channels[] = $channel;
    }

    return $channels;
  }

}
