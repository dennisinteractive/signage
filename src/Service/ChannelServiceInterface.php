<?php
namespace Drupal\signage\Service;

interface ChannelServiceInterface {

  /**
   * A list of channels that show the action.
   * @param $id
   *
   * @return array
   */
  public function getChannelNamesForActionId($id);
}
