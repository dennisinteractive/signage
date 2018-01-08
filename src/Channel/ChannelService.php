<?php
/**
 * Service for Channels.
 */

namespace Drupal\signage\Channel;

use Drupal\node\Entity\Node;

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
      $node =  Node::load($row);
      $channel->setNode($node);

      // Check for a minimum time on the action for the channel.
      $min = $channel->getCurrentUrlMinTime();
      if ($min > 0) {
        // no other action should be sent while within the minimum time.
        drupal_set_message("Action not sent as the minimum time requires another: $min seconds");
      }
      else {
        $channels[] = $channel;
      }
    }

    return $channels;
  }

}
