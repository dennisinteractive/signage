<?php
namespace Drupal\signage\Service;


interface ChannelServiceInterface {

  /**
   * A list of channel names that show the action.
   *
   * @param $id
   *
   * @return array
   */
  public function getChannelNamesForActionId($id);

  /**
   * A list of channels that show the action.
   *
   * @param $id
   *
   * @return array
   */
  public function getChannelsForActionId($id);
}
