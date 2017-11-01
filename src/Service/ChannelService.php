<?php
namespace Drupal\signage\Service;

class ChannelService implements ChannelServiceInterface {

  /**
   * @inheritDoc
   */
  public function getChannelNamesForActionId($id) {
    // TODO: Implement getChannelNamesForActionId() method.
    //drupal_set_message(__FUNCTION__);
    return ['Floor4', 'ChannelFoo'];
  }


}
