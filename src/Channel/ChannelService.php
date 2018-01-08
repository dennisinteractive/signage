<?php
/**
 * Service for Channels.
 */

namespace Drupal\signage\Channel;

use Drupal\node\Entity\Node;
use Drupal\signage\Action\ActionInterface;

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
  public function getChannelsForAction(ActionInterface $action) {
    // Find channel content with the action entity id
    // in field_signage_actions
    $query = \Drupal::entityQuery('node')
      ->condition('field_signage_actions', $action->getId())
    ;
    $rows = $query->execute();

    $channels = [];
    foreach ($rows as $row) {
      $channel = clone $this->channel;
      $node =  Node::load($row);
      $channel->setNode($node);

      // Check for a minimum time on the action for the channel.
      $min = $channel->getCurrentActionMinTime($action);
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
