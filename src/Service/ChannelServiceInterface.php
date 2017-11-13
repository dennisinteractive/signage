<?php
namespace Drupal\signage\Service;

use Drupal\signage\Action\ActionInterface;

interface ChannelServiceInterface {

  /**
   * A list of channels that show the action.
   * @param $id
   *
   * @return array
   */
  public function getChannelNamesForActionId($id);

  /**
   * Set current action.
   * @param int $channel_id
   * @param \Drupal\signage\Action\ActionInterface $action
   *
   * @return self
   */
  //public function setAction($channel_id, ActionInterface $action);
}
