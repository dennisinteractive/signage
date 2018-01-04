<?php
/**
 * Channel service interface.
 */

namespace Drupal\signage\Channel;

/**
 * Interface ChannelServiceInterface.
 *
 * @package Drupal\signage\Service
 */
interface ChannelServiceInterface {

  /**
   * A list of channels that show the action.
   *
   * @param int $id
   *
   * @return array
   */
  public function getChannelsForActionId($id);
}
