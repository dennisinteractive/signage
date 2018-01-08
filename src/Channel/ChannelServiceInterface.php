<?php
/**
 * Channel service interface.
 */

namespace Drupal\signage\Channel;

use Drupal\signage\Action\ActionInterface;

/**
 * Interface ChannelServiceInterface.
 *
 * @package Drupal\signage\Service
 */
interface ChannelServiceInterface {

  /**
   * A list of channels that show the action.
   *
   *
   * @param ActionInterface $action
   *
   * @return array
   */
  public function getChannelsForAction(ActionInterface $action);
}
