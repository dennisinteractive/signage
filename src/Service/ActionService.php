<?php
namespace Drupal\signage\Service;

use Drupal\signage\Action\Action;
use Drupal\signage\Event\InputEvent;

class ActionService implements ActionServiceInterface {

  /**
   * @inheritDoc
   */
  public function getActionsForInputEvent(InputEvent $event) {
    // TODO: Implement getActionIdsForSource() method.
    //drupal_set_message(__FUNCTION__);
    $action = new Action($event);
    return [$action];
  }

}
