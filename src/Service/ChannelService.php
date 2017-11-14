<?php
namespace Drupal\signage\Service;

use Drupal\signage\Channel\ChannelInterface;

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
  public function getChannelNamesForActionId($id) {
    // TODO: Implement getChannelNamesForActionId() method.
    //drupal_set_message(__FUNCTION__);
    return ['Floor4', 'devicexxx'];
  }


}
