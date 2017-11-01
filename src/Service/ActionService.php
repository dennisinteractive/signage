<?php
namespace Drupal\signage\Service;

use Drupal\signage\Action\Action;

class ActionService implements ActionServiceInterface {

  /**
   * @inheritDoc
   */
  public function getActionsForSource($name) {
    // TODO: Implement getActionIdsForSource() method.
    //drupal_set_message(__FUNCTION__);
    $action = new Action();
    return [$action];
  }

}
